<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HomestayReport extends Model
{
    use HasFactory, SoftDeletes;

    public $table = "homestay_reports";

    protected $fillable =
    [
        'id',
        'user_id',
        'homestay_id',
        'content',
        'status'
    ];
}
