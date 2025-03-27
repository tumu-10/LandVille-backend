<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyImage extends Model
{
    use HasFactory;

    protected $table = 'property_imgs'; // Specify the table name
    protected $fillable = ['img', 'created_at', 'updated_at'];

    protected $appends = ["img_url"];

    public function getImgUrlAttribute()
    {
        if ($this->img) {
            return url('storage/' . $this->img);
        }
        return null;
    }

}
