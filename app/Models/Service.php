<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['name', 'slug', 'description'];

    public function providers()
    {
        return $this->belongsToMany(ServiceProvider::class, 'provider_services');
    }
}

