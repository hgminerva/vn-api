<?php

namespace App\Http\Controllers;

use App\Http\Requests\LabelRequest;
use App\Http\Resources\LabelResource;
use App\Models\Label;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class LabelController extends Controller
{
    // display list
    public function index(): AnonymousResourceCollection
    {
        $labels = Label::all();

        return LabelResource::collection($labels);
    }
    // save
    public function store(Request $request): LabelResource
    {
        $label = Label::create($request->all());

        return new LabelResource($label);
    }
    // detail
    public function show($id): LabelResource
    {
        $label = Label::findOrFail($id);

        return new LabelResource($label);
    }
    // edit
    public function update(Request $request, $id): LabelResource
    {
        $label = Label::findOrFail($id);
        $label->update($request->all());

        return new LabelResource($label->refresh());
    }
    // delete
    public function destroy($id): Response
    {
        $label = Label::findOrFail($id);
        $label->delete();

        return response()->noContent();
    }
}
