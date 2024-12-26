<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function notification_cowork()
    {
        return $this->belongsTo(Cowork::class, 'space_id');
    }

    public function notification_user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function notification_transaction(){
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }


}
