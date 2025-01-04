<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeskField extends Model
{
    use HasFactory;

    protected $table = 'desk_fields';
    protected $guarded = [];

    public function cowork()
    {
        return $this->belongsTo(Cowork::class, 'space_id');
    }
}
