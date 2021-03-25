<?php

namespace App\Http\Controllers;

use App\Http\Requests\VaccineUrlRequest;
use App\Http\Resources\VaccineUrlResource;

use App\SearchFilters\SearchVaccineUrl;

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
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function listAllVaccineURL(): AnonymousResourceCollection
    {
        $vaccine_urls = VaccineUrl::with('us_state')->orderBy('id', 'DESC')->get();

        return VaccineUrlResource::collection($vaccine_urls); 
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function listAllVaccineUrlZipcodes(): AnonymousResourceCollection 
    {
        $vaccine_urls = VaccineUrl::select('id', 'zipcodes', 'latitude', 'longitude', 'description', 'rank')->get();
        
        return VaccineUrlResource::collection($vaccine_urls); 
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function listPharmacyURL(): AnonymousResourceCollection
    {
        $vaccine_urls = VaccineUrl::with('us_state')->orderBy('id', 'DESC')
                                ->where('category','PHARMACY')->paginate();

        return VaccineUrlResource::collection($vaccine_urls); 
    }

    /**
     * Display a listing of the resource.
     *
    * @return AnonymousResourceCollection
     */
    public function listVaccineUrlsPerState(VaccineUrlRequest $request): AnonymousResourceCollection
    {
        $us_state_id = $request->us_state_id;
        $vaccine_urls = VaccineUrl::where('us_state_id',$us_state_id)->with('us_state')
                                    ->orderBy('id', 'DESC')->get();

        return VaccineUrlResource::collection($vaccine_urls);   
    }

    /**
     * Display a listing of the resource.
     *
    * @return AnonymousResourceCollection
     */
    public function listOfAllPlaces(VaccineUrlRequest $request): AnonymousResourceCollection
    {
        $us_state_id = $request->us_state_id;   
        $vaccine_urls = VaccineUrl::where('us_state_id',$us_state_id)
                                  ->select('county')
                                  ->groupBy('county')
                                  ->orderBy('county')
                                  ->get();
        
        return VaccineUrlResource::collection($vaccine_urls);                           
    }

    /**
     * Available filters.
     *
     * @return array
     */
    protected function filters()
    {
        return [
            'search' => SearchVaccineUrl::class,
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function query(VaccineUrlRequest $request): AnonymousResourceCollection
    {
        // $query = VaccineUrl::query();

        // $availableFilters = collect($this->filters())
        //     ->filter(function ($filter, $key) use ($request) {
        //         return $request->has($key);
        //     });

        // foreach ($availableFilters as $key => $filter) {
        //     $query = (new $filter)->handle($query, $request->get($key));
        // }

        // $vaccine_urls = $query->with('us_state')->get();
        
        $value = $request->search;
        $vaccine_urls = VaccineUrl::join('us_states', 'us_states.id', '=', 'vaccine_urls.us_state_id')
                                    ->orWhere('vaccine_urls.description','like', '%' . $value . '%')
                                    ->orWhere('us_states.state_name','like', '%' . $value . '%')
                                    ->orWhere('us_states.state_initial','like', '%' . $value . '%')
                                    ->orWhere('vaccine_urls.zipcodes','like', '%' . $value . '%')
                                    ->orWhere('vaccine_urls.site_message','like', '%' . $value . '%')
                                    ->orWhere('vaccine_urls.county','like', '%' . $value . '%')
                                    ->orWhere('vaccine_urls.status','like', '%' . $value . '%')
                                    ->orWhere('vaccine_urls.remarks','like', '%' . $value . '%')
                                    ->select('vaccine_urls.id', 
                                             'vaccine_urls.state_initial',
                                             'vaccine_urls.zipcodes', 
                                             'vaccine_urls.latitude', 
                                             'vaccine_urls.longitude', 
                                             'vaccine_urls.description', 
                                             'vaccine_urls.rank', 
                                             'vaccine_urls.status',
                                             'vaccine_urls.site_message',
                                             'vaccine_urls.url_address',
                                             'vaccine_urls.url_registration')
                                    ->get();


        return VaccineUrlResource::collection($vaccine_urls);
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function queryByStateName(VaccineUrlRequest $request): AnonymousResourceCollection
    {        
        $vaccine_urls = VaccineUrl::join('us_states', 'us_states.id', '=', 'vaccine_urls.us_state_id')
                                    ->where('us_states.state_name','like', '%' . $request->state_name . '%')
                                    ->select('vaccine_urls.id', 
                                             'vaccine_urls.state_initial',
                                             'vaccine_urls.zipcodes', 
                                             'vaccine_urls.latitude', 
                                             'vaccine_urls.longitude', 
                                             'vaccine_urls.description', 
                                             'vaccine_urls.rank', 
                                             'vaccine_urls.status',
                                             'vaccine_urls.site_message',
                                             'vaccine_urls.url_address',
                                             'vaccine_urls.url_registration')
                                    ->get();
        return VaccineUrlResource::collection($vaccine_urls);
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function queryByPlace(VaccineUrlRequest $request): AnonymousResourceCollection
    {        
        $vaccine_urls = VaccineUrl::join('us_states', 'us_states.id', '=', 'vaccine_urls.us_state_id')
                                  ->where('us_states.state_name','like', '%' . $request->state_name . '%')
                                  ->where('vaccine_urls.county','like', '%' . $request->place . '%')
                                  ->select('vaccine_urls.id', 
                                            'vaccine_urls.state_initial',
                                            'vaccine_urls.zipcodes', 
                                            'vaccine_urls.latitude', 
                                            'vaccine_urls.longitude', 
                                            'vaccine_urls.description', 
                                            'vaccine_urls.rank', 
                                            'vaccine_urls.status',
                                            'vaccine_urls.site_message',
                                            'vaccine_urls.url_address',
                                            'vaccine_urls.url_registration')
                                    ->get();
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
