<?php

namespace App\Http\Controllers;

use App\Http\Requests\DoctorApplicationRequest;
use App\Http\Resources\DoctorApplicationResource;
use App\Models\DoctorApplication;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class DoctorApplicationController extends Controller
{
    // display list
    public function index(): AnonymousResourceCollection
    {
       // $doctor_applications = DoctorApplication::all();
        $doctor_applications = DoctorApplication::with('doctor', 'institutionjobposting', 'institution')->get();

        return DoctorApplicationResource::collection($doctor_applications);
    }

    // applications by doctor
    public function applications_by_doctor(DoctorApplicationRequest $request): AnonymousResourceCollection
    {
        $applications = DoctorApplication::with('doctor', 'institutionjobposting', 'institution')
                                         ->where('doctor_id',$request->doctor_id)
                                         ->get();

        return DoctorApplicationResource::collection($applications);
    }

    // applications by institution_job_postings
    public function applications_by_job_posting(DoctorApplicationRequest $request): AnonymousResourceCollection
    {
        $applications = DoctorApplication::with('doctor', 'institutionjobposting', 'institution')
                                         ->where('job_posting_id',$request->job_posting_id)
                                         ->get();

        return DoctorApplicationResource::collection($applications);
    }

    // save
    public function store(DoctorApplicationRequest $request): DoctorApplicationResource
    {
        $doctor_application = DoctorApplication::create($request->all());

        return new DoctorApplicationResource($doctor_application);
    }

    // display detail
    public function show($id): DoctorApplicationResource
    {
        $doctor_application = DoctorApplication::with('doctor', 'institutionjobposting', 'institution')
                                                ->findOrFail($id);

        return new DoctorApplicationResource($doctor_application);
    }

    // update
    public function update(DoctorApplicationRequest $request, $id): DoctorApplicationResource
    {
        $doctor_application = DoctorApplication::findOrFail($id);
        $doctor_application->update($request->all());

        return new DoctorApplicationResource($doctor_application->refresh());
    }

    // delete
    public function destroy($id): Response
    {
        $doctor_application = DoctorApplication::findOrFail($id);
        $doctor_application->delete();

        return response()->noContent();
    }
}
