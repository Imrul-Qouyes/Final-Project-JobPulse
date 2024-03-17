<?php

namespace App\Models\Candidate;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateBasicInformation extends Model
{
    use HasFactory;

    protected $table = 'candidate_basic_informations';
    protected $fillable = [
        'full_name',
        'father_name',
        'mother_name',
        'date_of_birth',
        'blood_group',
        'nid',
        'passport_no',
        'cellphone_no',
        'emergency_contact_no',
        'email',
        'whatsapp_no',
        'linkedin_link',
        'fb_id',
        'github_link',
        'behance_or_dribble_link',
        'portfolio_link',
        'candidate_id'
    ];

    public function candidate(){

        return $this->belongsTo(Candidate::class);
    }

}
