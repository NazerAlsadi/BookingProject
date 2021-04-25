<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\roomtype;

class book extends Model
{
    use HasFactory;
    
    public function roomtype()
    {
        return $this->belongsTo(roomtype::class);
    }
}
