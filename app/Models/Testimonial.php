<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;


    protected $fillable = ['name', 'desc', 'avatar'];

    protected $appends = ["avatar_url"];

    public function getAvatarUrlAttribute()
    {
        return asset('storage/'. $this->avatar);
    }
}
