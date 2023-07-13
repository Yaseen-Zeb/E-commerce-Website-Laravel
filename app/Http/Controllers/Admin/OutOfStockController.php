<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Storage;
// use Illuminate\Support\Facades\Request ;
use Illuminate\Support\Facades\DB;


class OutOfStockController extends Controller
{
    public function out_of_stock ()
    {

      $data["out_of_stock"] =DB::table("products")
       ->distinct()
       ->select("products.*")
       ->join("product_attr",["product_attr.product_id"=>"products.p_id"])
       ->where("product_attr.qty","=",0)
       ->get();

       foreach ($data["out_of_stock"] as $value) {
        $data["attr"][$value->p_id] =  DB::table("product_attr")
        ->select("product_attr.*","color_name","size_name")
        ->leftjoin("colors",["colors.id"=>"product_attr.color_id"])
        ->leftjoin("sizes",["sizes.id"=>"product_attr.size_id"])
        ->where("product_attr.qty","=",0)->where(["product_id"=>$value->p_id])->get();
       }

      //  show_arr($data);
      //  die();
       return view("admin.out_of_stock",$data);

    }

   
}
