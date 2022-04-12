<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookingDetail extends Model
{
    use HasFactory, SoftDeletes;

    public $table = "booking_details";

    protected $fillable =
    [
        'id',
        'booking_id',
        'room_id',
        'price',
        'quantity_room',
    ];
}
