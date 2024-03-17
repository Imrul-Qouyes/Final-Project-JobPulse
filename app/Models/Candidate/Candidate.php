<?php

namespace App\Models\Candidate;

use App\Models\CandidateAppliedJob;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = ['firstname','lastname','email','password','otp','google_id','image_url'];

    protected $attributes = ['otp'=>'0'];

    public function basicInfo(){

        return $this->hasOne(CandidateBasicInformation::class);
    }

    public function educationDetail(){

        return $this->hasMany(CandidateEducationDetail::class);
    }

    public function traningDetail(){

        return $this->hasMany(CandidateTrainingDetail::class);
    }

    public function experienceDetail() {

        return $this->hasMany(CandidateExperienceDetail::class);
    }

    public function skillAndSalary() {

        return $this->hasOne(CandidateSkillAndSalary::class);
    }

    public function appliedJobs()
    {
        return $this->hasMany(CandidateAppliedJob::class,'candidate_id');
    }
}
