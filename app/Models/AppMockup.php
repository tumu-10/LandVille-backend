<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AppMockup extends Model
{
    use HasFactory;
    protected $fillable = ['image_path'];
}

