<?php

namespace App\Models\JobserviceOwner;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutPageDetail extends Model
{
    use HasFactory;

    protected $fillable = ['title','company_mission','company_vision','company_history','image_url'];
}
