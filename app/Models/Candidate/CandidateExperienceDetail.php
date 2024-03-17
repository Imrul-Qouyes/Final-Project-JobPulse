<?php

namespace App\Models\Candidate;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateExperienceDetail extends Model
{
    use HasFactory;

    protected $fillable = ['designation','company_name','join_date','deperture_date','candidate_id'];

    public function candidate(){

        return $this->belongsTo(Candidate::class);
    }
}
