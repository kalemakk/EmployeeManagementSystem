<?php


namespace App\Services;


use Illuminate\Support\Facades\DB;

class Feeder
{
    public function productTypes(){
        return DB::table('product_types')->get();
    }

    public function paymentTypes(){
        return DB::table('payment_types')->get();
    }

    public static function branches(){
        return DB::table('branches')->select(['id','name'])->get();
    }

    public static function depts(){
        return DB::table('departments')->select(['id','name'])->get();
    }

}
