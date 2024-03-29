<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'court_id', 'total_price', 'unique_code', 'status',
        'booking_start', 'booking_end', 'expired_at', 'payment_method', 'payment_service', 'payment_code', 'payment_link'
    ];

    protected $casts = [
        'booking_start' => 'datetime',
        'booking_end' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function court()
    {
        return $this->belongsTo(Court::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
