<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    use HasFactory;

    protected $table = 'machines';

    protected $fillable = [
       'type_id',
       'serialno',
       'proj_id',
       'mac_address',
    ];

}
