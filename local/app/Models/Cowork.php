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
        return $this->hasMany(\App\Models\Transaction::class);
    }

    public function cowork_in_favorites(){
        return $this->hasMany(\App\Models\Favorite::class);
    }

    // public function user_cowork(){
    //     return $this->belongsTo(User::class);
    // }

    public function cowork_reviews()
    {
        return $this->hasMany(Review::class, 'cowork_id');
    }

    public function cowork_average_review($id)
    {
        $averageRating = Review::where('cowork_id', $id)
        ->avg('rating');

        if($averageRating === null){
            $averageRating = 0;
        }

        return $averageRating;
    }
}
