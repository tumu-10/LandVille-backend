<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $table = 'service_new';
    protected $fillable = ['services_title', 'services_desc', 'sub_services', 'services_img', 'services_video'];
    protected $casts = [
        'sub_services' => 'array', // Automatically cast sub_services as an array
    ];
    protected $appends = [ "services_img_url", "services_video_url" ];

    public function getServicesImgUrlAttribute()
    {
        if ($this->services_img) {
            return url('storage/' . $this->services_img);
        }
        return null;
    }
    public function getServicesVideoUrlAttribute()
    {
        if ($this->services_video) {
            return url('storage/' . $this->services_video);
        }
        return null;
    }
}
