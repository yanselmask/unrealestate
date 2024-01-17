<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'features' => 'array'
    ];

    public function prices()
    {
        return $this->belongsToMany(Currency::class)->withPivot('price');
    }

    public function price(): Attribute
    {
        return Attribute::make(
            get: function () {
                $defaultCurrency = setting('localization_default_currency');
                $pivot = $this->prices->where('code', currency()->getUserCurrency() ?? $defaultCurrency)->first();

                return $pivot ?  currency_price($pivot->pivot->price, currency()->getUserCurrency() ?? $defaultCurrency) : null;
            }
        );
    }

    public function onlyPrice(): Attribute
    {
        return Attribute::make(
            get: function () {
                $defaultCurrency = setting('localization_default_currency');
                $pivot = $this->prices->where('code', currency()->getUserCurrency() ?? $defaultCurrency)->first();

                return $pivot ?  $pivot->pivot->price : 0;
            }
        );
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot(['start_at', 'end_at', 'canceled_at', 'used_listing', 'used_ads', 'limit_listing', 'limit_ads', 'status']);
    }
}
