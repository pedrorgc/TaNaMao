<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceProvider extends Model
{
    protected $fillable = ['name', 'bio', 'phone', 'email', 'city', 'rating'];

    public function services()
    {
        return $this->belongsToMany(Service::class, 'provider_services')
                    ->withPivot('price');
    }
}
