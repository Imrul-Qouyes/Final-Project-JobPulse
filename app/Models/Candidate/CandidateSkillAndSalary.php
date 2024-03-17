<?php

namespace App\Models\Candidate;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateSkillAndSalary extends Model
{
    use HasFactory;

    protected $fillable = ['skills','current_salary','expected_salary','candidate_id'];

    public function candidate(){

        return $this->belongsTo(Candidate::class);
    }
}
