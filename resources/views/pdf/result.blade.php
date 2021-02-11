@extends('layouts.app')

@section('content')
<div class="font-weight-bold text-center text-primary" style="font-size: 1.5rem;">PCR Test Notification</div>
<div class="text-center text-secondary">(SARS-CoV-2)</div>
<!-- <div class="text-right">
    Date Printed: {{ date('m/d/Y', strtotime($created_at)) }}
</div> -->
<div style="width: 55%; margin-left: auto; margin-right:auto; padding-top: 8rem; padding-bottom: 8rem;">
    <table>
        <tbody>
            <tr>
                <td>[Inspection Date]: </td>
                <td class="font-weight-bold">{{ date('m/d/Y', strtotime($created_at)) }}</td>
            </tr>
            <tr>
                <td>[Id]: </td>
                <td class="font-weight-bold">{{ $order_number }}</td>
            </tr>
            <tr>
                <td>[Name]: </td>
                <td class="font-weight-bold">{{ $customer_name }}</td>
            </tr>
        </tbody>
    </table>
</div>

<div style="padding-bottom: 5rem;">
    @if (strtoupper($result) == 'NEGATIVE')

    <div class="text-center">
        <span class="text-primary" style="font-size: 1.5rem;">{{ strtoupper($result) }}: </span> Not Detected
    </div>
    @else
    <div class="text-center">
        <span class="text-danger" style="font-size: 1.5rem;">{{ strtoupper($result) }}: </span> Detected
    </div>
    @endif
</div>

<div class="text-center">
    <h2>Logo Here</h2>
</div>
@endsection

