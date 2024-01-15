<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Outdoor extends Model
{
    use HasFactory, HasTranslations;

    protected $guarded = [];

    public array $translatable = ['name'];


    public function properties()
    {
        return $this->belongsToMany(Property::class)->withPivot('distance');
    }
}
