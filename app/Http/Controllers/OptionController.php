<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

use App\Models\Option;
use App\Http\Resources\OptionResource;

class OptionController extends Controller
{
    // display list
    public function index(): AnonymousResourceCollection
    {
        $options = Option::all();
        return OptionResource::collection($options);

    }
    // display list by option_type
    public function options_by_option_type(Request $request): AnonymousResourceCollection
    {
        $option_type = $request->option_type;
        $option_type = Option::where('option_type', $option_type)
                             ->orderBy('option_type')->get();

        return OptionResource::collection($option_type);
    }
    // save
    public function store(Request $request): OptionResource
    {
        $option = Option::create($request->all());

        return new OptionResource($option);
    }
    // display
    public function show($id): OptionResource
    {
        $option = Option::findOrFail($id);

        return new OptionResource($option);
    }
    // update
    public function update(Request $request, $id): OptionResource
    {
        $option = Option::findOrFail($id);
        $option->update($request->all());

        return new OptionResource($option->refresh());
    }
    // delete
    public function destroy($id): Response
    {
        $option = Option::findOrFail($id);
        $option->delete();

        return response()->noContent();
    }
}
