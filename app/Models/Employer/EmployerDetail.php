<?php

namespace App\Models\Employer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployerDetail extends Model {
    use HasFactory;

    protected $fillable = [
        'company_name', 
        'company_address', 
        'company_size', 
        'company_type', 
        'business_description', 
        'contactPerson_name', 
        'contactPerson_email', 
        'contactPerson_designation', 
        'company_establishYear', 
        'employer_id'
    ];

    public function employer(){

        return $this->belongsTo(Employer::class);
    }



}
