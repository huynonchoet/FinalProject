<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StatisticIncome extends Model
{
    use HasFactory, SoftDeletes;

    public $table = "statistic_incomes";

    protected $fillable = [
        'id',
        'homestay_id',
        'month',
        'year',
        'total',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
