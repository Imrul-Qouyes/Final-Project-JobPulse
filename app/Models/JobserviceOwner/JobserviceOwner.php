<?php

namespace App\Models\JobserviceOwner;

use App\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobserviceOwner extends Model
{
    use HasFactory;

    protected $fillable = ['employee_name','email','password','otp','role_id'];

    protected $attributes = ['otp'=>'0'];

    public function role(){

        return $this->hasOne(Role::class,'id','role_id');
    }
}
