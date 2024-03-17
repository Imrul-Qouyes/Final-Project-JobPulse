<?php

namespace App\Models;


use App\Models\Employer\EmployerDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllJob extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_title',
        'job_description',
        'job_skills',
        'job_benefits',
        'salary',
        'employment_type',
        'location',
        'deadline',
        'status',
        'published_at',
        'employer_id'
    ];

    public function employerDetail(){

        return $this->belongsTo(EmployerDetail::class,'employer_id','employer_id');
    }

    public function appliedJobs(){
        return $this->hasMany(CandidateAppliedJob::class,'id');
    }


}
