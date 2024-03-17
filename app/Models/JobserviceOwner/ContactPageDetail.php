<?php

namespace App\Models\JobserviceOwner;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactPageDetail extends Model
{
    use HasFactory;

    protected $fillable = ['contact_title','address','phone','telephone','email','image_url'];
}
