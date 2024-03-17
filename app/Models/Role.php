<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\JobserviceOwner\JobserviceOwner;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    public function jobserviceOwner(){

        return $this->belongsTo(JobserviceOwner::class);
    }
}
