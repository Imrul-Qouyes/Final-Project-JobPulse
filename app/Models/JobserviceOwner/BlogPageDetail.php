<?php

namespace App\Models\JobserviceOwner;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPageDetail extends Model
{
    use HasFactory;

    protected $fillable = ['blog_title','blog_banner_url'];
}
