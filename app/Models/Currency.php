<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function properties()
    {
        return $this->belongsToMany(Property::class)->withPivot('price');
    }

    public function packages()
    {
        return $this->belongsToMany(Package::class)->withPivot('price');
    }
}
