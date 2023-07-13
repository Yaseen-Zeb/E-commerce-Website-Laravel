<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ReviewsController extends Controller
{
    public function reviews_show()
    {
        $data["reviews"] = DB::table("reviews")
        ->select("reviews.msg","reviews.id","reviews.status","reviews.date","reviews.rating","users.name","users.mobile","users.email","users.created_at","products.title","products.image")
        ->join("users",["users.email"=>"reviews.user_id"])
        ->join("products","products.slug","like","reviews.p_slug")
        ->get();
       return view("admin.reviews",$data);
    }

    public function status($status,$id)
        {
           DB::table("reviews")->where(["id"=>$id])->update(["status"=>$status]);
           return redirect("/admin_penal/reviews");
        }
}
