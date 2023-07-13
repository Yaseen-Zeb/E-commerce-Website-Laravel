<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function show()
    {

       $data["orders"] = DB::table("orders")
       ->select("orders.*","order_status.status")
       ->join("order_status",["order_status.id" => "orders.order_status"])
       ->get();
    //    show_arr($data);
    //     die();
       return view("admin.orders",$data);
    }

    public function details($id)
    {
        $data["data"] = DB::table("orders_detail")
        ->select("order_status","order_id","products.image","products.slug","coupons.code","product_attr.price as product_price","orders.total_price as af_coupon","orders.address","orders.mobile","orders.city","orders.zip","orders.name","products.title","orders_detail.qty","color_name","size_name")
        ->where(["order_id"=>$id])
        ->join("products",["products.p_id" => "orders_detail.p_id"])
        ->join("orders",["orders.id" => "orders_detail.order_id"])
        ->join("product_attr",["product_attr.attr_id" => "orders_detail.attr_id"])
        ->leftjoin("colors",["colors.id" => "product_attr.color_id"])
        ->leftjoin("sizes",["sizes.id" => "product_attr.size_id"])
        ->leftjoin("coupons","coupons.code","Like","orders.coupon_code")
        ->get();
        $data["order_status"] = DB::table("order_status")->get();
       return view("admin.order_details",$data);
    }

    public function update_order_status($status,$order_id)
    {
        DB::table("orders")->where(["id" => $order_id])->update(["order_status"=>$status]);
        return redirect()->back();
    }
}
