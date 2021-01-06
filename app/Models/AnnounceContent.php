<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnounceContent extends Model
{
    use HasFactory;

    protected $table = 'announce_contents';

    protected $fillable = [
        'proj_id',
        'name',
        'mime_type',
        'url',
        'detail',
        'status',
        'start_datetime',
        'stop_datetime',
    ];

}
