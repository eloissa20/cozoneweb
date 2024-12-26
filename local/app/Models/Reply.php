<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

    protected $table = 'replies';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship where a review belongs to a cowork (list_space_tbl)
    public function review()
    {
        return $this->belongsTo(Review::class, 'review_id');
    }

    public function cowork()
    {
        return $this->belongsTo(Cowork::class, 'cowork_id');
    }
}