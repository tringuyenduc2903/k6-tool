<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    protected $fillable = [
        'api',
        'transfer_time',
        'concurrent_users',
    ];
}
