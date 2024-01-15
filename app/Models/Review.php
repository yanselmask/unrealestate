<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    use \Conner\Likeable\Likeable;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
