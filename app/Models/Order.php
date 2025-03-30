<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customerNumber', 'customerNumber');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'statusID', 'statusID');
    }

    public function auditLogs()
    {
        return $this->hasMany(AuditLog::class, 'orderID', 'orderID');
    }
}
