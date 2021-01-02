<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marquee extends Model
{
    use HasFactory;

    protected $fillable = [
       'proj_id',
       'name',
       'marquee1',
       'marquee2',
       'marquee3',
       'marquee4',
       'mqrquee5',
       'marquee6',
       'marquee7',
       'marquee8',
       'marquee9',
       'marquee10',
       'status',
       'start_datetime',
       'stop_datetime',
    ];

}
