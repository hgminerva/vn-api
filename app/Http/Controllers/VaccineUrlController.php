<?php

namespace App\Http\Controllers;

use App\Http\Requests\VaccineUrlRequest;
use App\Http\Resources\VaccineUrlResource;
use App\Models\VaccineUrl;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class VaccineUrlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
    * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $vaccine_urls = VaccineUrl::with('us_state')->orderBy('id', 'DESC')->paginate();

        return VaccineUrlResource::collection($vaccine_urls);   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return VaccineUrlResource
     */
    public function store(VaccineUrlRequest $request): VaccineUrlResource
    {
        $vaccine_url = VaccineUrl::create($request->all());

        return new VaccineUrlResource($vaccine_url);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return VaccineUrlResource
     */
    public function show($id): VaccineUrlResource
    {
        $vaccine_url = VaccineUrl::with('us_state')->findOrFail($id);

        return new VaccineUrlResource($vaccine_url);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     * @return VaccineUrlResource
     */
    public function update(VaccineUrlRequest $request, $id): VaccineUrlResource
    {
        $vaccine_url = VaccineUrl::findOrFail($id);

        $vaccine_url->update($request->all());

        return new VaccineUrlResource($vaccine_url->refresh());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function destroy($id): Response
    {
        $vaccine_url = VaccineUrl::findOrFail($id);

        $vaccine_url->delete();

        return response()->noContent();
    }
}
