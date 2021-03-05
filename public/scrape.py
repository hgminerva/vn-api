import sys
sys.path.append('/home/ubuntu/.local/lib/python3.8/site-packages')

import pgeocode
import requests
import mysql.connector

from datetime import datetime
from fake_useragent import UserAgent
from bs4 import BeautifulSoup

mydb=mysql.connector.connect(
        host="localhost",
        user="vn",
        passwd="liteclerk",
        database="vndb")

dbCursor=mydb.cursor()

headers={ 'User-Agent': 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36' }

argvId = 0
if sys.argv:
   argvId = int(sys.argv[1]) 

# ==============================
# Scrape and create notification
# ==============================

# notification batch information
batch_number = datetime.now().strftime('%Y%m%d%H%M%S')
batch_date = datetime.now().strftime('%Y-%m-%d')
batch_time = datetime.now().strftime('%H-%M-%S')


sql = "SELECT id, url_address, zipcodes, category, phase_served FROM vaccine_urls WHERE category!='PHARMACY'"
if argvId > 0:
    sql1 = "SELECT us_state_id FROM customer_users WHERE id=" + str(argvId)
    dbCursor.execute(sql1)
    user_filters=dbCursor.fetchall()
    for user_filter in user_filters:
        filter_us_state_id = user_filter[0]         
        sql = "SELECT id, url_address, zipcodes, category, phase_served FROM vaccine_urls WHERE category!='PHARMACY' AND us_state_id=" + str(filter_us_state_id)


dbCursor.execute(sql)
urls=dbCursor.fetchall()
for url in urls:

    urlId = url[0]
    urlAddress = url[1]
    urlZipcodes = url[2]
    urlCategoryTags = url[3]
    urlPhaseServed = url[4]

    print("------------------------------------------------")
    print(urlAddress)

    try:

        #scrape website and save to db if the argument id is 0
        if argvId == 0:
           request = requests.get(urlAddress, headers=headers, timeout=1.5).text
           soup = BeautifulSoup(request, 'html.parser')
        
           #save scrape data
           tags = urlCategoryTags.split('|')
           if len(tags) == 2:
              tag = tags[0]
              tag_class = tags[1]
              data = soup.find(tag, class_=tag_class)
              if data:
                 sql = "UPDATE vaccine_urls SET current_content='" + data.get_text().replace("'","").strip() + "' WHERE id=" + str(urlId)
                 dbCursor.execute(sql)
                 mydb.commit()

        #zip code US geo settings
        dist = pgeocode.GeoDistance('us')
        
        #process all only if the argument id is 0, otherwise only the specify user id
        sql = "SELECT id, zipcodes, distance_willing, user_number, age_group, us_state_category_id, us_state_id FROM customer_users"
        if argvId > 0: 
           sql = "SELECT id, zipcodes, distance_willing, user_number, age_group, us_state_category_id, us_state_id FROM customer_users WHERE id=" + str(argvId) 
        
        dbCursor.execute(sql)
        users=dbCursor.fetchall()
        
        for user in users:

            # user information
            userId = user[0]
            userZipcodes = user[1]
            userDistanceWilling = user[2] * 1.60934 #Convert miles to kilometer
            userName = user[3]
            userUsStateCategoryId = user[5]

            # distance willing to travel criteria
            criteria_distance = False            
            zipcodes = userZipcodes.split(',')
            for zc in zipcodes:
                if zc:
                    print(zc)
                    z = zc.split('|')
                    #print(z[1] + ',' + urlZipcodes)
                    d = dist.query_postal_code(z[1],urlZipcodes)
                    if d <= userDistanceWilling:
                         criteria_distance = True
            
            # phase criteria
            criteria_phase = False     
            phase_sql = "SELECT category FROM us_state_categories where id=" + str(userUsStateCategoryId)
            dbCursor.execute(phase_sql)
            us_state_categories=dbCursor.fetchall()
            for us_state_category in us_state_categories:
                if us_state_category:


            if criteria_distance == True:
                try:        
                    print("=====>>>>Adding Notification Logs: " + userName)
                    
                    sql = "INSERT INTO notifications(batch_number, batch_date, batch_time, customer_user_id, vaccine_url_id, is_sms_sent, is_email_sent) VALUES (%s, %s, %s, %s, %s, %s, %s)"
                    val = (batch_number, batch_date, batch_time, userId, urlId, False, False)
                    
                    dbCursor.execute(sql, val)
                    mydb.commit()

                    #mailRequest =  requests.get('https://liteclerk-app.com/api/customer_users/email/' + str(userId))
                    #smsRequest =  requests.get('https://liteclerk-app.com/api/customer_users/sms/' + str(userId))
                except mydb.exceptions.RequesException as e:
                    print(e)

    except requests.exceptions.RequestException as e:
        print(e)


# =================
# Send Notification
# =================

print("NOTIFYING....")

dbCursor.execute("SELECT batch_number, customer_user_id FROM notifications WHERE batch_number = '" + batch_number + "' GROUP BY customer_user_id")
notifications = dbCursor.fetchall()
for notification in notifications:
    customer_user_id = notification[1]
    
    print("Sending Notification: " + str(customer_user_id))
    
    try:
        mailRequest =  requests.get('https://gs-vaccinetracker.liteclerk-app.com/api/customer_users/email/' + str(customer_user_id) + "/" + batch_number, verify=False)
        smsRequest =  requests.get('https://gs-vaccinetracker.liteclerk-app.com/api/customer_users/sms/' + str(customer_user_id), verify=False)  
        
        sql = "UPDATE notifications SET is_sms_sent=True, is_email_sent=True WHERE batch_number='" + batch_number + "' AND customer_user_id=" + str(customer_user_id)
        dbCursor.execute(sql)
        mydb.commit()

    except mailRequest.exceptions.RequestException as e: 
        print(e)