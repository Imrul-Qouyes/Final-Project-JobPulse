<?php

namespace App\Models\Employer;

use App\Models\AllJob;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    use HasFactory;

    protected $fillable = ['firstname','lastname','email','password','otp','google_id','status'];

    protected $attributes = ['otp'=>'0'];


    public function employerDetail(){

        return $this->hasOne(EmployerDetail::class);
    }

    public function jobs(){

        return $this->hasMany(AllJob::class);
    }
}
