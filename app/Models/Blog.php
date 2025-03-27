<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = ['blog_title', 'blog_desc', 'blog_img', 'blog_author', 'date',];

    protected $appends = [ "blog_img_url"];

    public function getBlogImgUrlAttribute()
    {
        if ($this->blog_img) {
            return url('storage/' . $this->blog_img);
        }
        return null;
    }
}
