<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marquee extends Model
{
    use HasFactory;

    protected $table = 'marquees';

    protected $fillable = [
       'proj_id',
       'name',
       'index',
       'marquee',
       'status',
       'start_datetime',
       'stop_datetime',
    ];

}
