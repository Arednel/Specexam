<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'can_register',
        'can_start_test',
    ];
}
