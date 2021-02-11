<?php

namespace App\Http\Controllers;

use App\Http\Requests\InstitutionRequest;
use App\Http\Resources\InstitutionResource;
use App\Models\Institution;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class InstitutionController extends Controller
{
    // display list
    public function index(): AnonymousResourceCollection
    {
        $institutions = Institution::with('user')->paginate();
        return InstitutionResource::collection($institutions);
    }
    //user institutions
    public function institutions_by_user(InstitutionRequest $request): AnonymousResourceCollection
    {
        $institutions = Institution::with('user')
                                   ->where('user_id',$request->user_id)
                                   ->get();
        return InstitutionResource::collection($institutions);
    }
    // save
    public function store(InstitutionRequest $request): InstitutionResource
    {
        $institutions = Institution::create($request->all());

        return new InstitutionResource($institutions);
    }
    // display detail
    public function show($id): InstitutionResource
    {
        $institution = Institution::findOrFail($id);

        return new InstitutionResource($institution);
    }
    // update
    public function update(InstitutionRequest $request, $id): InstitutionResource
    {
        $institution = Institution::findOrFail($id);
        $institution->update($request->all());

        return new InstitutionResource($institution->refresh());
    }
    // delete
    public function destroy($id): Response
    {
        $institution = Institution::findOrFail($id);
        $institution->delete();

        return response()->noContent();
    }
}
