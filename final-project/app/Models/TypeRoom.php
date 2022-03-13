<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeRoom extends Model
{
    use HasFactory, SoftDeletes;

    public $table = "type_rooms";

    protected $fillable = ['name'];
}
