<?php

namespace App\Http\Controllers;

use App\Http\Requests\DoctorFavoriteJobRequest;
use App\Http\Resources\DoctorFavoriteJobResource;
use App\Models\DoctorFavoriteJob;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class DoctorFavoriteJobController extends Controller
{
    // display list
    public function index(): AnonymousResourceCollection
    {
        $doctor_favorite_jobs = DoctorFavoriteJob::with('doctor','institutionjobposting')->get();

        return DoctorFavoriteJobResource::collection($doctor_favorite_jobs);
    }
    
    // doctor favorite jobs
    public function favorite_jobs_by_doctor(DoctorFavoriteJobRequest $request): AnonymousResourceCollection
    {
        $favorite_jobs = DoctorFavoriteJob::with('doctor', 'institutionjobposting')
                                          ->where('doctor_id',$request->doctor_id)
                                          ->get();

        return DoctorFavoriteJobResource::collection($favorite_jobs);
    }

    // save
    public function store(DoctorFavoriteJobRequest $request): DoctorFavoriteJobResource
    {
        $doctor_favorite_job = DoctorFavoriteJob::create($request->all());

        return new DoctorFavoriteJobResource($doctor_favorite_job);
    }

    // display detail
    public function show($id): DoctorFavoriteJobResource
    {
        $doctor_favorite_job = DoctorFavoriteJob::findOrFail($id);

        return new DoctorFavoriteJobResource($doctor_favorite_job);
    }

    // update
    public function update(DoctorFavoriteJobRequest $request, $id): DoctorFavoriteJobResource
    {
        $doctor_favorite_job = DoctorFavoriteJob::findOrFail($id);
        $doctor_favorite_job->update($request->all());

        return new DoctorFavoriteJobResource($doctor_favorite_job->refresh());
    }

    // delete
    public function destroy($id): Response
    {
        $doctor_favorite_job = DoctorFavoriteJob::findOrFail($id);
        $doctor_favorite_job->delete();

        return response()->noContent();
    }
}
