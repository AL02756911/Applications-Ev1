<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Status extends Model
{
    use HasFactory;
    
    public function orders()
    {
        return $this->hasMany(Order::class, 'statusID', 'statusID');
    }
}
