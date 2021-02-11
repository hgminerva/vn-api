<?php

namespace App\Http\Controllers;

use App\Http\Requests\DoctorEvaluationRequest;
use App\Http\Resources\DoctorEvaluationResource;
use App\Models\DoctorEvaluation;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class DoctorEvaluationController extends Controller
{
    // display list
    public function index(): AnonymousResourceCollection
    {
       // $doctor_evaluations = DoctorEvaluation::all();
        $doctor_evaluations = DoctorEvaluation::with('doctor', 'institution')->get();

        return DoctorEvaluationResource::collection($doctor_evaluations);
    }

    // doctors evaluation
    public function doctor_evaluation_by_doctor(DoctorEvaluationRequest $request): AnonymousResourceCollection
    {
        $doctor_evaluations = DoctorEvaluation::with('doctor', 'intitution')
                            ->where('doctor_id', $request->doctor_id)
                            ->get();

        return DoctorEvaluationResource::collection($doctor_evaluations);
    }

    // save
    public function store(DoctorEvaluationRequest $request): DoctorEvaluationResource
    {
        $doctor_evaluation = DoctorEvaluation::create($request->all());

        return new DoctorEvaluationResource($doctor_evaluation);
    }

    // display detail
    public function show($id): DoctorEvaluationResource
    {
        $doctor_evaluation = DoctorEvaluation::findOrFail($id);

        return new DoctorEvaluationResource($doctor_evaluation);
    }

    // update
    public function update(DoctorEvaluationRequest $request, $id): DoctorEvaluationResource
    {
        $doctor_evaluation = DoctorEvaluation::findOrFail($id);
        $doctor_evaluation->update($request->all());

        return new DoctorEvaluationResource($doctor_evaluation->refresh());
    }

    // delete
    public function destroy($id): Response
    {
        $doctor_evaluation = DoctorEvaluation::findOrFail($id);
        $doctor_evaluation->delete();

        return response()->noContent();
    }
}
