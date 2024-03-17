<?php

namespace App\Models;

use App\Models\Candidate\Candidate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateAppliedJob extends Model {
    use HasFactory;

    protected $fillable = ['job_id', 'candidate_id', 'applied_date', 'selection_status'];

    public function candidates() {

        return $this->belongsTo( Candidate::class,'candidate_id' )->with(['basicInfo','educationDetail','traningDetail','experienceDetail','skillAndSalary']);

    }


    public function allJobs() {

        return $this->belongsTo( AllJob::class,'job_id' );

    }
}
