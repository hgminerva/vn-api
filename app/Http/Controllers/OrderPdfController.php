<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Mail\SendPdfToCustomer;
use Illuminate\Http\JsonResponse;
use Barryvdh\DomPDF\Facade as Pdf;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;

class OrderPdfController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return JsonResponse
     */
    public function sendToEmail($id): JsonResponse
    {
        $data = Order::findOrFail($id);

        $pdf = Pdf::loadView('pdf.result', $data);

        Mail::to($data->email)->send(new SendPdfToCustomer($data, $pdf));

        return response()->json(['status' => 'Mail successfully sent!'], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function exportToPdf($id): Response
    {
        $data = Order::findOrFail($id);

        $pdf = Pdf::loadView('pdf.result', $data);

        return $pdf->stream();
    }
}
