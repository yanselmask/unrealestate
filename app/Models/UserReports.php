<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserReports extends Model
{
    use HasFactory;

    public $table = 'user_reports';

    public function user()
    {
        return $this->hasOne(User::class);
    }
    public function property()
    {
        return $this->hasOne(Property::class);
    }
    public function reason()
    {
        return $this->hasOne(ReportReason::class);
    }
}
