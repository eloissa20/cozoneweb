<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeactivatedUser extends Model
{
    use HasFactory;

    protected $table = 'deactivated_users';

    protected $fillable = [
        'name',
        'email',
        'contact',
        'birthday',
        'gender',
        'address',
        'user_type',
        'email_verified_at',
        'password',
        'remember_token',
        'created_at',
        'updated_at',
    ];
}
