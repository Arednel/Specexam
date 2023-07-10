<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'privilege' => 'User',
    ];

    protected $fillable = [
        'email',
        'password',
        'full_name',
        'iin',
        'speciality',
        'educational_institution',
        'exam_start',
        'last_try',
    ];
}
