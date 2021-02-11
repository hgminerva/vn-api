<?php

namespace Tests\Feature;

use App\Models\InstitutionJobPosting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InstitutionJobPostingControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function institution_job_posting_should_be_able_to_query_for_area()
    {
        InstitutionJobPosting::factory()->create();

        $response = $this->json('POST', 'api/institution_job_postings/query', [
                'area' => 'test',
            ])
            ->assertOk();
    }

    /** @test */
    public function institution_job_posting_should_be_able_to_query_for_job_type()
    {
        InstitutionJobPosting::factory()->create();

        $response = $this->json('POST', 'api/institution_job_postings/query', [
                'job_type' => 'test',
            ])
            ->assertOk();
    }

    /** @test */
    public function institution_job_posting_should_be_able_to_query_for_keywords()
    {
        InstitutionJobPosting::factory()->create();

        $response = $this->json('POST', 'api/institution_job_postings/query', [
                'keywords' => 'test',
            ])
            ->assertOk();
    }

    /** @test */
    public function institution_job_posting_should_be_able_to_query_for_medical_departments()
    {
        InstitutionJobPosting::factory()->create();

        $response = $this->json('POST', 'api/institution_job_postings/query', [
                'medical_departments' => 'test',
            ])
            ->assertOk();
    }

    /** @test */
    public function institution_job_posting_should_be_able_to_query_for_search()
    {
        InstitutionJobPosting::factory()->create();

        $response = $this->json('POST', 'api/institution_job_postings/query', [
                'search' => 'test',
            ])
            ->assertOk();
    }
}
