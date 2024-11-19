<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cowork extends Model
{
    use HasFactory;

    protected $table = 'list_space_tbl';
    protected $guarded = [];

    public function cowork_in_transaction(){
        return $this->hasMany(\App\Models\Transactions::class);
    }

    public function cowork_in_favorites(){
        return $this->hasMany(\App\Models\Favorites::class);
    }

    // public function user_cowork(){
    //     return $this->belongsTo(User::class);
    // }

    public function cowork_reviews()
    {
        return $this->hasMany(Reviews::class, 'cowork_id');
    }
}