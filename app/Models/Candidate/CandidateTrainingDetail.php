<?php

namespace App\Models\Candidate;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateTrainingDetail extends Model
{
    use HasFactory;

    protected $fillable = ['training_name','training_institution','completion_year','candidate_id'];

    public function candidate() {

        return $this->belongsTo(Candidate::class);
    }
}
