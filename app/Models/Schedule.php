<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id', 'court_id', 'booking_start', 'booking_end'
    ];

    public function court()
    {
        return $this->belongsTo(Court::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
