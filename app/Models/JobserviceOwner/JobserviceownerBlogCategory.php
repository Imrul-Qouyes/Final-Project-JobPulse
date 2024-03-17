<?php

namespace App\Models\JobserviceOwner;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobserviceownerBlogCategory extends Model
{
    use HasFactory;

    protected $fillable = ['blog_category_name'];

    public function posts() {

        return $this->hasMany(JobserviceownerBlogPost::class);
    }
}
