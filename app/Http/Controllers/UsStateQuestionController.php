<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsStateQuestionRequest;
use App\Http\Resources\UsStateQuestionResource;
use App\Models\UsStateQuestion;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class UsStateQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
    * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $us_state_questions = UsStateQuestion::with('us_state')->get();

        return UsStateQuestionResource::collection($us_state_questions);
                           
    }

    /**
     * Display a listing of the resource.
     *
    * @return AnonymousResourceCollection
     */
    public function questionsByUSState(UsStateQuestionRequest $request): AnonymousResourceCollection
    {
        $us_state_questions = UsStateQuestion::with('us_state')
                                ->where('us_state_id', $request->us_state_id)
                                ->get();

        return UsStateQuestionResource::collection($us_state_questions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return UsStateQuestionResource
     */
    public function store(UsStateQuestionRequest $request): UsStateQuestionResource
    {
        $us_state_question = UsStateQuestion::create($request->all());

        return new UsStateQuestionResource($us_state_question);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return UsStateQuestionResource
     */
    public function show($id): UsStateQuestionResource
    {
        $us_state_question = UsStateQuestion::findOrFail($id);

        return new UsStateQuestionResource($us_state_question);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     * @return UsStateQuestionResource
     */
    public function update(UsStateQuestionRequest $request, $id): UsStateQuestionResource
    {
        $us_state_question = UsStateQuestion::findOrFail($id);

        $us_state_question->update($request->all());

        return new UsStateQuestionResource($us_state_question->refresh());
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
        $us_state_question = UsStateQuestion::findOrFail($id);

        $us_state_question->delete();

        return response()->noContent();
    }
}
