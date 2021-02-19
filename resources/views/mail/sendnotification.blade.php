@extends('layouts.app')

@section('content')

<div style="background-color: #efefef; padding: 45px 0px;">
<div style="width: 600px; margin: 0px auto; background-color: #fff; border-radius: 10px; text-align: center; padding: 25px 25px 45px 25px;">
<img style="margin-bottom: 35px; height: 100px" src="https://vaccinetracker.pinnaclecare.com/assets/img/company_logo/pc2.png" />
<div style="clear:both; height:15px;"></div>
<div style="text-align:left">Good day! {{ $customer_user->name }}</div>
<div style="clear:both; height:15px;"></div>
<div style="text-align:left">Check your notifications below</div>
<div style="clear:both; height:15px;"></div>
<!-- Start -- LOOP THIS DIV -->
<div class="loop-div-notif-entries" style="text-align:left; padding:20px; background:#eaeaea; border:1px solid #939494;">Notification Entry</div>
<!-- End -- LOOP THIS DIV -->
<div style="clear:both; height:15px;"></div>
</div>
</div>

@endsection
