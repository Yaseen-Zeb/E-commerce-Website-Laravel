<?php

function wishlist_count()
{
    $wishlist_count = 0;
if (session()->has("login") == true) {
    $wishlist_count = count(DB::table("wishlist")->where(["u_email"=>session("user_email")])->get());
}
return $wishlist_count;
}


function show_arr($array)
{
   echo "<pre>";
   print_r($array);
}
function nav_data()
{
   //Browse start
   $nav_data["browse_categories"] = DB::table("categories")->where(["status"=>1,"home_show"=>1])->get();
   foreach ($nav_data["browse_categories"] as $val) {
       $nav_data["browse__sub_categories"][$val->cat_id]["section1"] = DB::table("sub_categories")->where(["cat_id"=>$val->cat_id,"status"=>1])->offset(0)->limit(5)->get();
       $nav_data["browse__sub_categories"][$val->cat_id]["section2"] = DB::table("sub_categories")->where(["cat_id"=>$val->cat_id,"status"=>1])->offset(5)->limit(5)->get();
       $nav_data["browse__sub_categories"][$val->cat_id]["section3"] = DB::table("sub_categories")->where(["cat_id"=>$val->cat_id,"status"=>1])->offset(10)->limit(5)->get();
   }
   //browse end


   //Nav Collection start
   $nav_data["our_collection"] = DB::table("categories")->where(["categories.status"=>1,"our_collection"=>1])->limit(5)->get();
   foreach ($nav_data["our_collection"] as $val) {
       // if (count(DB::table("sub_categories")->where(["cat_id"=>$val->cat_id,"status"=>1])->offset(0)->limit(5)->get()) > 0) {
        $nav_data["our_collection_sub_categories"][$val->cat_id]= DB::table("sub_categories")->where(["cat_id"=>$val->cat_id,"status"=>1])->offset(0)->limit(6)->get();
       // }
      
   }
   //Nav Collection end

   return $nav_data;
}

function cart_pop()
{
    if (session()->has("user_email")) {
        $u_id = session("user_email");
    } else {
        if (session()->has("user_temp_id")) {
            $u_id = session("user_temp_id");
        } else {
           $u_id = rand(111111111,999999999);
           session()->put("user_temp_id",$u_id);
        }
    }
    
   $cart_pop = DB::table("cart")
   ->distinct()
   ->select("products.title","products.p_id","product_attr.color_id","product_attr.size_id","product_attr.price","products.image","cart.qty","color_name","size_name","products.slug")
   ->join("products",["cart.p_id"=>"products.p_id"])
   ->join("product_attr",["cart.attr_id"=>"product_attr.attr_id"])
   ->leftjoin("colors",["product_attr.color_id"=>"colors.id"])
   ->leftjoin("sizes",["product_attr.size_id"=>"sizes.id"])
   ->where(["user_id"=>$u_id,])
   ->get();
   return $cart_pop;
}



