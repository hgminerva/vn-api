<?php

namespace App\Http\Controllers;

use App\Http\Requests\DoctorRequest;
use App\Http\Resources\DoctorResource;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class DoctorController extends Controller
{
    // display list
    public function index(): AnonymousResourceCollection
    {
        $doctors = Doctor::with('user')->paginate();

        return DoctorResource::collection($doctors);
    }
    // user doctors
    public function doctors_by_user(DoctorRequest $request): AnonymousResourceCollection
    {
        $doctors = Doctor::with('user')
                         ->where('user_id',$request->user_id)
                         ->get();
        return DoctorResource::collection($doctors);
    }
    // save
    public function store(DoctorRequest $request): DoctorResource
    {
        $doctor = Doctor::create($request->all());

        return new DoctorResource($doctor);
    }
    // display detail
    public function show($id): DoctorResource
    {
        $doctor = Doctor::findOrFail($id);

        return new DoctorResource($doctor);
    }
    // update
    public function update(DoctorRequest $request, $id): DoctorResource
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->update($request->all());

        return new DoctorResource($doctor->refresh());
    }
    // delete
    public function destroy($id): Response
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->delete();

        return response()->noContent();
    }

    public function upload_image(Request $request){

        // $file = $request->file('image');
        // $filename  = $file->getClientOriginalName();

        // $path = $request->file('image')->move(public_path("app/public/"), $fileName);

        // $photoURL = url('app/public/'.$fileName);

        $result = $request->file('image')->store('public/images');
        return response()->json(['url' => $result], 200);
    }

    public function doctor_image($path){

        $path = storage_path('public' . $filename);

        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
        // return Image::make(storage_path('public/' . $path))->response();
        // $file = \Illuminate\Support\Facades\Storage::get($path);
        // return response($file, 200)->header('Content-Type', 'image/jpeg');
    }
}
