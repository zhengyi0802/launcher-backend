<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCatagory extends Model
{
    use HasFactory;

    protected $table = 'product_catagories';

    protected $fillable = [
       'name',
       'detail',
    ];

}
