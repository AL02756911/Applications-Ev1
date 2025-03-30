<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AuditLog extends Model
{
    use HasFactory;

    public function order()
    {
        return $this->belongsTo(Order::class, 'orderID', 'orderID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userID', 'id');
    }
}
