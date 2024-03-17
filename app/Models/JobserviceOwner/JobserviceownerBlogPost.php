<?php

namespace App\Models\JobserviceOwner;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobserviceownerBlogPost extends Model
{
    use HasFactory;


    protected $fillable = ['title','content','status','image','published_at','category_id','user_id'];

    public function category(){

        return $this->belongsTo(JobserviceownerBlogCategory::class,'category_id');
    }

    public function user(){

        return $this->belongsTo(JobserviceOwner::class,'user_id');

    }
}

