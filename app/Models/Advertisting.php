<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisting extends Model
{
    use HasFactory;

    protected $table = 'advertistings';

    protected $fillable = [
       'proj_id',
       'name',
       'position',
       'url',
       'detail',
       'status',
       'start_datetime',
       'stop_datetime',
    ];
}
