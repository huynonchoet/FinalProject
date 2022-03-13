<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'name',
        'images',
        'price',
        'description',
        'discount',
        'quantity_room',
        'status',
        'homestay_id',
        'type_room_id',
        'created_at',
    ];

    /**
     * Get the user that owns the room.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the typeRoom that owns the room.
     */
    public function typeRoom()
    {
        return $this->belongsTo(TypeRoom::class);
    }
    
    /**
     * Get the boking detail that owns the room.
     */
    public function bookingDetails()
    {
        return $this->hasMany(BookingDetail::class);
    }

    /**
     * Get the typeRoom that owns the room.
     */
    public function homestay()
    {
        return $this->belongsTo(Homestay::class);
    }
}
