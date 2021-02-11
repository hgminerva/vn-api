@extends('layouts.app')

@section('content')
<h3>Good day! {{ $order->customer_name }}</h3>

<div>
    Attached is your RT-PCR Test Result.
</div>
@endsection
