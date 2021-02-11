<?php

namespace App\Http\Controllers;

use App\Http\Requests\InstitutionJobPostingRequest;
use App\Http\Resources\InstitutionJobPostingResource;
use App\Models\InstitutionJobPosting;
use App\SearchFilters\AreaFilter;
use App\SearchFilters\JobTypeFilter;
use App\SearchFilters\KeywordFilter;
use App\SearchFilters\MedicalDepartmentsFilter;
use App\SearchFilters\SearchParamFilter;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class InstitutionJobPostingController extends Controller
{

    // display list
    public function index(): AnonymousResourceCollection
    {
        $institution_job_postings = InstitutionJobPosting::with('institution')->paginate();
        return InstitutionJobPostingResource::collection($institution_job_postings);
    }

    /**
     * Available filters.
     *
     * @return array
     */
    protected function filters()
    {
        return [
            'area'                => AreaFilter::class,
            'job_type'            => JobTypeFilter::class,
            'keyword'             => KeywordFilter::class,
            'medical_departments' => MedicalDepartmentsFilter::class,
            'search'              => SearchParamFilter::class,
        ];
    }

    public function query(InstitutionJobPostingRequest $request): AnonymousResourceCollection
    {
        $query = InstitutionJobPosting::query();

        $availableFilters = collect($this->filters())
            ->filter(function ($filter, $key) use ($request) {
                return $request->has($key);
            });

        foreach ($availableFilters as $key => $filter) {
            $query = (new $filter)->handle($query, $request->get($key));
        }

        $institution_job_postings = $query->with('institution')->paginate();

        return InstitutionJobPostingResource::collection($institution_job_postings);
    }

    // institution job postings
    public function job_postings_by_institution(InstitutionJobPostingRequest $request): AnonymousResourceCollection
    {
        $institution_job_postings = InstitutionJobPosting::where('institution_id',$request->institution_id)
                                                          ->with('institution')
                                                          ->paginate();

        return InstitutionJobPostingResource::collection($institution_job_postings);
    }

    // save
    public function store(InstitutionJobPostingRequest $request): InstitutionJobPostingResource
    {
        $institution_job_posting = InstitutionJobPosting::create($request->all());

        return new InstitutionJobPostingResource($institution_job_posting);
    }

    // display detail
    public function show($id): InstitutionJobPostingResource
    {
        $institution_job_posting = InstitutionJobPosting::with('institution')
                                                         ->findOrFail($id);

        return new InstitutionJobPostingResource($institution_job_posting);
    }

    // update
    public function update(InstitutionJobPostingRequest $request, $id): InstitutionJobPostingResource
    {
        $institution_job_posting = InstitutionJobPosting::findOrFail($id);
        $institution_job_posting->update($request->all());

        return new InstitutionJobPostingResource($institution_job_posting->refresh());
    }

    // delete
    public function destroy($id): Response
    {
        $institution_job_posting = InstitutionJobPosting::findOrFail($id);
        $institution_job_posting->delete();

        return response()->noContent();
    }
}
