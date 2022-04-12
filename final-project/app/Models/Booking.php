<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'user_id',
        'day_start',
        'day_end',
        'status',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    public function getStatusLabelAttribute()
    {
        return [
            '0' => 'Pending',
            '1' => 'Accepted',
            '2' => 'Cancelled'
        ][$this->status];
    }
}
