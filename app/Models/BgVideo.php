<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BgVideo extends Model
{
    use HasFactory;
    protected $fillable = ['video_path', 'created_at', 'updated_at'];

    protected $appends = ["video_path_url"];// Allow these columns to be filled with data

    public function getVideoPathUrlAttribute()
    {
        if ($this->video_path) {
            return url('storage/' . $this->video_path);
        }
        return null;
    }
}
