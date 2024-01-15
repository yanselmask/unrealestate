<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPurchasedPackage extends Model
{
    use HasFactory;

    public function modal()
    {
        return $this->morphTo();
    }
    public function package()
    {
        return $this->belongsTo(Package::class);
    }
    public function customer()
    {
        return $this->belongsTo(User::class, 'model_id');
    }
}
