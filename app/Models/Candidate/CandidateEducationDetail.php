<?php

namespace App\Models\Candidate;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateEducationDetail extends Model
{
    use HasFactory;

    protected $fillable = ['degree_type','education_institution','department','passing_year','result','candidate_id'];

    public function candidate(){

        return $this->belongsTo(Candidate::class);
    }
}
