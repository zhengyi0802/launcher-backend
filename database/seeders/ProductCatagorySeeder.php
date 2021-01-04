<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ProductCatagorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productCatagory = new ProductCatagory;
        $productCatagory->name = '機上盒';
        $productCatagory->detail = '機上盒';
        $productCatagory->save();
        $productCatagory->name = '聲霸';
        $productCatagory->detail = '聲霸';
        $productCatagory->save();
        $productCatagory->name = '配件';
        $productCatagory->detail = '配件';
        $productCatagory->save();
    }
}
