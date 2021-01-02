<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logo extends Model
{
    use HasFactory;

    protected $fillable = [
       'proj_id',
       'name',
       'url',
       'detail',
       'status',
       'start_datetime',
       'stop_datetime',
    ];
}
