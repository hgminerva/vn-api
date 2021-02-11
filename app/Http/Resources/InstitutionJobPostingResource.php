<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InstitutionJobPostingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'institution_id' => $this->institution_id,
            'institution' => new InstitutionResource($this->whenLoaded('institution')),
            'image_url' => $this->image_url,
            'job_posting_number' => $this->job_posting_number,
            'job_posting_title' => $this->job_posting_title,
            'job_posting_date' => $this->job_posting_date,
            'job_posting_expiry_date' => $this->job_posting_expiry_date,
            'job_title' => $this->job_title,
            'job_type' => $this->job_type,
            'tag_line' => $this->tag_line,
            'medical_department' => $this->medical_department,
            'description' => $this->description,
            'attention_points' => $this->attention_points,
            'recruitment_background' => $this->recruitment_background,
            'recommended_points' => $this->recommended_points,
            'gender' => $this->gender,
            'keywords' => $this->keywords,
            'enable' => $this->enable,
    
            'salary' => $this->salary,
            'working_hours' => $this->working_hours,
            'number_of_working_days' => $this->number_of_working_days,
            'starting_date_of_work' => $this->starting_date_of_work,
            'required_skills' => $this->required_skills,
            'required_qualification' => $this->required_qualification,
            'minimum_experience_years' => $this->minimum_experience_years,
            'desired_skills_and_experience' => $this->desired_skills_and_experience,
            'welcomed_experience' => $this->welcomed_experience,
            'with_duty' => $this->with_duty,
            'with_stand_by' => $this->with_stand_by,
            'with_research_day' => $this->with_research_day,
    
            'bonus' => $this->bonus,
            'salary_increase' => $this->salary_increase,
            'various_allowances' => $this->various_allowances,
            'various_insurances' => $this->various_insurances,
            'academic_participation' => $this->academic_participation,
            'assistant_academic_participation' => $this->assistant_academic_participation,
            'work_life_balance' => $this->work_life_balance,
            'overtime' => $this->overtime,
            'number_of_cases' => $this->number_of_cases,
            'doctor_system' => $this->doctor_system,
            'holidays' => $this->holidays,
            'paid_leave' => $this->paid_leave,
            'other_holidays' => $this->other_holidays,
            'retirement_pay' => $this->retirement_pay,
            'nursery' => $this->nursery,
            
            'work_location' => $this->work_location,
            'facility_type' => $this->facility_type,
            'office_hours' => $this->office_hours,
            'means_from_nearest_station' => $this->means_from_nearest_station,
            'nearest_station' => $this->nearest_station,
            'transportation' => $this->transportation,
            'nearest_line' => $this->nearest_line,
            'can_commute_by_car' => $this->can_commute_by_car,
            'area' => $this->area
        ];
    }
}
