<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengunjung extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $primaryKey = 'noktp';
    protected $dates = ['created_at'];
}
