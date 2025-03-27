<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Collage extends Model
{
    use HasFactory;
    protected $fillable = ['image'];

    protected $appends = [ "image_url"];

    public function getImageUrlAttribute()
    {
        return asset('storage/'. $this->image);
    }
}
