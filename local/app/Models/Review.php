<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    // Define the relationship where a review belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship where a review belongs to a cowork (list_space_tbl)
    public function cowork()
    {
        return $this->belongsTo(Cowork::class, 'cowork_id');
    }
}