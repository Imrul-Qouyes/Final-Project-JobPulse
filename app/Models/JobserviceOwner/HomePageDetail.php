<?php

namespace App\Models\JobserviceOwner;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomePageDetail extends Model
{
    use HasFactory;

    protected $fillable = ['logo_title','hero_title','hero_details','logo_image_url','hero_image_url'];
}
