@extends('layouts.app')

@section('content')

<div class="banner" style="background-color: #f0f0f0; padding: 45px 0px; font-family: avenir !important; height: 100%">
<div style="width: 600px; margin: 0px auto;text-align: center; ">
<div style="background-image: url(banner-dark.png);background-position: center center; height: 175px;background-repeat: no-repeat;background-size: contain;">
<div style="clear:both; height:100px; "></div>
<img style="margin-left: 25px; margin-bottom: -10px; height: 40px; float: left;" src="logo.png" />
<div style="clear:both; height:1px;"></div>
<div style="text-align:left !important; padding-left: 120px !important; font-size:15px;font-family: calibri; color: #fffffe;">Vaccine Tracker Notification</div>
</div>
</div>
<div style="width: 550px; margin: 0px auto; background-color: #fff;padding: 25px 25px 45px 25px; margin-top:-1px">

	<div>
		<div class="phase" style="background-color: #14b46c; width: 80px; height: 80px; border-radius: 10px; float: left">
			<div style="float: center; padding-top: 30px;color: #fff; text-align:center;">{{ $customer_user->us_state_category->category }}</div>
		</div>
		<div style="float: center; padding: 10px; font-size: 14px; color: gray;margin-bottom: 10px">
			<table style="margin-left: 90px">
			<tr>
				<td style="width: 100px">Name</td>
				<td>{{ $customer_user->name }}</td>
			</tr>
			<tr>
				<td style="width: 100px">Employee ID</td>
				<td>{{ $customer_user->user_number }}</td>
			</tr>
			<tr>
				<td style="width: 100px">Distance</td>
				<td>{{ $customer_user->distance_willing }}</td>
			</tr>
			</table>
		</div>
	</div>
	<div style="clear:both; height:10px;"></div>
	<!-- Loop Here -->
	<div style="margin-top:30px;border: solid #e6e6e6 1px; padding: 25px;background-color: #fafafa;">
		<div style="font-size: 12px!important; font-weight: 900!important;">
			<div style="text-align:left;">[Provider Name]</div>
			<div style="text-align:left">Address [Address]</div>
			<div style="text-align:left">Date: [Date Posted]&nbsp;&nbsp;&nbsp;&nbsp;Time: [Time Posted]</div>
		</div>
		<div style="clear:both; height:15px;"></div>
		<div style="font-size:13px;  ">Content Here</div>
		<div style="clear:both; height:10px;"></div>
		<button style="background-color: #5b5e65;border: none; height:30px; width: 120px;color: #fff"><a href="/" style="text-decoration: none;color: #fff;">Page Link</a></button >&nbsp;&nbsp;<button style="background-color: #14b46c;border: none; height:30px; width: 150px;color: #fff;"><a href="/" style="text-decoration: none;color: #fff;">Registration Link</a></button>
	</div>
	<!-- Loop Here -->
</div>

<!-- Footer -->
<div class="footer" style="color: #fff;width: 550px; margin: 0px auto; background-color: #5b5e65; text-align: center; padding: 25px 25px 45px 25px; margin-top:-1px">
<div style="width: 80%: float: center;font-size:12px; padding: 10px">Disclaimers help companies protect themselves against legal claims by addressing liabilities specific to their operations.</div>
</div>




@endsection
