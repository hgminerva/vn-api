@extends('layouts.app')

@section('content')
<h3>Good day! {{ $customer_user->name }}</h3>

<div>
    Vaccine Tracker:  You have the following match results:
</div>
@endsection
