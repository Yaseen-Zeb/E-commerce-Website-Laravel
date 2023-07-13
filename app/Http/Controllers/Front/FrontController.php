<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class FrontController extends Controller
{
        // home page work start
    public function index()
    {
    $data["categories"] = DB::table("categories")->where(["status"=>1,"home_show"=>1])->get();
    $data["brands"] = DB::table("brands")->where(["status"=>1,"home_show"=>1])->get();
      

    $data["featured_products"] = DB::table("products")
    ->distinct()
    ->select("products.*","sub_categories.*")
    ->join("product_attr",["product_attr.product_id"=>"products.p_id"])
    ->where("product_attr.qty","!=",0)
    ->join("sub_categories",["products.sub_cat_id"=>"sub_categories.id"])->where(["is_featured"=>1])->get();
    foreach ($data["featured_products"] as $value) {
        $data["featured_products_attr"][$value->p_id]= DB::table("product_attr")
        ->distinct()
        ->select("product_attr.*")
        ->leftjoin("colors",["product_attr.color_id"=>"colors.id"])
        ->leftjoin("sizes",["product_attr.size_id"=>"sizes.id"])
        ->where("product_attr.qty","!=",0)
        ->where(["product_id"=>$value->p_id])
        ->get();
        foreach ($data["featured_products"] as $value) {
            if (isset(DB::table("product_images")
            ->where(["p_id"=>$value->p_id])
            ->limit(1)
            ->get()[0])) {
            $data["featured_hover_products_image"][$value->p_id]= DB::table("product_images")
            ->where(["p_id"=>$value->p_id])
            ->limit(1)
            ->get()[0]->image;
            }
    }
}
// show_arr($data["featured_products_attr"]);
// die();

    $data["trending_products"] = DB::table("products")
    ->distinct("")
    ->select("products.*","sub_categories.*")
    ->join("product_attr",["product_attr.product_id"=>"products.p_id"])
    ->where("product_attr.qty","!=",0)
    ->join("sub_categories",["products.sub_cat_id"=>"sub_categories.id"])->where(["is_trending"=>1])->get();
    foreach ($data["trending_products"] as $value) {
        $data["trending_products_attr"][$value->p_id]= DB::table("product_attr")
        ->leftjoin("colors",["product_attr.color_id"=>"colors.id"])
        ->leftjoin("sizes",["product_attr.size_id"=>"sizes.id"])
        ->where("product_attr.qty","!=",0)
        ->where(["product_id"=>$value->p_id])
        ->get();
    foreach ($data["trending_products"] as $value) {
        if (isset(DB::table("product_images")
        ->where(["p_id"=>$value->p_id])
        ->limit(1)
        ->get()[0])) {
             $data["trending_hover_products_image"][$value->p_id]= DB::table("product_images")
        ->where(["p_id"=>$value->p_id])
        ->limit(1)
        ->get()[0]->image;
        }
       
    }
}

    $data["discounted_products"] = DB::table("products")
    ->distinct("")
    ->select("products.*","sub_categories.*")
    ->join("product_attr",["product_attr.product_id"=>"products.p_id"])
    ->where("product_attr.qty","!=",0)
    ->join("sub_categories",["products.sub_cat_id"=>"sub_categories.id"])
    ->where(["is_discounted"=>1])
    
    ->get();
    foreach ($data["discounted_products"] as $value) {
        $data["discounted_products_attr"][$value->p_id]= DB::table("product_attr")
        ->leftjoin("colors",["product_attr.color_id"=>"colors.id"])
        ->leftjoin("sizes",["product_attr.size_id"=>"sizes.id"])
        ->where("product_attr.qty","!=",0)
        ->where(["product_id"=>$value->p_id])
        ->get();
        foreach ($data["discounted_products"] as $value) {
            if (isset(DB::table("product_images")
            ->where(["p_id"=>$value->p_id])
            ->limit(1)
            ->get()[0])) {
                 $data["discounted_hover_products_image"][$value->p_id]= DB::table("product_images")
            ->where(["p_id"=>$value->p_id])
            ->limit(1)
            ->get()[0]->image;
            }
    }
}

$data["new_products"] =  DB::table("products")
->distinct()
->select("products.*")
  ->join("product_attr",["product_attr.product_id"=>"products.p_id"])
  ->where("product_attr.qty","!=",0)
 ->orderby("p_id","desc")
 ->limit(20)
->get();
foreach ($data["new_products"] as $value) {
 $data["new_products_attr"][$value->p_id] = DB::table("product_attr")
 ->select("price","image","mrp")
 ->where(["product_id"=>$value->p_id])
 ->get();
}
    $data["home_banner"] = DB::table("home_banners")->where(["status"=>1])->get();


//    echo "<pre>";
//    print_r($data["discounted_products_attr"]); 
//    die();
   

return view("front.index",$data);
    }
// home page work end


// product-details page work start
    public function product($slug)
    {

        $data["reviews"] = DB::table("reviews")
        ->select("reviews.msg","reviews.date","reviews.rating","users.name","users.created_at")
        ->join("users",["users.email"=>"reviews.user_id"])
        ->where(["reviews.p_slug"=>$slug,"reviews.status"=>1])
        ->get();
        // show_arr($data["reviews"]);
        // die();

       $data["product"] =  DB::table("brands")
       ->rightjoin("products",["brands.id"=>"products.brand_id"])
        ->join("sub_categories",["products.sub_cat_id"=>"sub_categories.id"])
       ->where(["slug"=>$slug])->get();
    //    show_arr($data["product"]);
    //    die();
       $data["product_attr"] = DB::table("product_attr")
       ->where(["product_id"=>$data["product"][0]->p_id])
       ->where("product_attr.qty","!=",0)
       ->get();
    //    show_arr($data["product_attr"]);
    //    die();


       $data["product_images"] =  DB::table("product_images")
       ->where(["p_id"=> $data["product"][0]->p_id])->get();


       $data["related_products"] =  DB::table("products")
       ->join("sub_categories",["products.sub_cat_id"=>"sub_categories.id"])
       ->where(["sub_cat_id"=> $data["product"][0]->sub_cat_id])
       ->where("slug","!=",$data["product"][0]->slug)
       ->get();

    foreach ($data["related_products"] as $value) {
    if (isset(DB::table("product_images")->where(["p_id"=>$value->p_id])->get()[0])) {
     $data["related_hover_products_image"][$value->p_id]= DB::table("product_images")
    ->where(["p_id"=>$value->p_id])
    ->get()[0]->image;
    }
    }

    foreach ($data["related_products"] as $key => $val) {
    $data["related_products_attr"][$val->p_id] =  DB::table("product_attr")
    ->leftjoin("colors",["product_attr.color_id"=>"colors.id"])
    ->leftjoin("sizes",["product_attr.size_id"=>"sizes.id"])
    ->where(["product_id"=>$val->p_id])
    ->get();
    }


    $attr_for_color = DB::table("product_attr")
    ->leftjoin("colors",["product_attr.color_id"=>"colors.id"])
    ->leftjoin("sizes",["product_attr.size_id"=>"sizes.id"])
    ->where(["product_id"=>$data["product"][0]->p_id])
    ->where("product_attr.qty","!=",0)
    ->get();
    $data["avalible_colors"] = [];
    foreach ($attr_for_color as $val) {
        if (!in_array($val->color_name,$data["avalible_colors"]) && $val->color_name != "") {
            $data["avalible_colors"][$val->color_id] =  $val->color_name;
        }
    
    }

    $attr_for_size = DB::table("product_attr")
    ->leftjoin("sizes",["product_attr.size_id"=>"sizes.id"])
    ->where(["product_id"=>$data["product"][0]->p_id])
    ->where("product_attr.qty","!=",0)
    ->get();
    $data["avalible_sizes"] = [];
    foreach ($attr_for_size as $val) {
        if (!in_array($val->size_name,$data["avalible_sizes"]) && $val->size_name != "") {

            $data["avalible_sizes"][$val->size_id] =  $val->size_name;
        }
    }
    // show_arr($data["product_attr"]);---------------------------------
    // die();
       return view("front.product",$data);
    }

    public function get_colors($pid,$sid)
    {
        $colors = DB::table("product_attr")
        ->leftjoin("colors",["product_attr.color_id"=>"colors.id"])
        ->where(["product_id"=>$pid,"size_id"=>$sid])
        ->where("product_attr.qty","!=",0)
        
        ->get();
        $Ar = [];
        foreach ($colors as $value) {
            $Ar[$value->color_id] = $value->color_name;
        }
        $str = '';
        foreach (array_unique($Ar)  as $key => $value) {
            
            if (isset($value) && ($value != "")) {
                $str .= '<li class="colors"><a href="javascript:void(0)"><span onclick="get('.$pid.','.$sid.','.$key.',2)" style="background-color:'.strtolower($value).'"></span></a></li>';
            }
        }
echo json_encode(["result"=>$str]);
    }

    public function get_attr_data($pid,$sid,$cid)
    {
        $attr = DB::table("product_attr")
        ->where(["product_id"=>$pid,"size_id"=>$sid,"color_id"=>$cid])
        // ->where("product_attr.qty",">",0)
        ->get();

        $finding_orders_qty = DB::table("orders")
        ->select("orders_detail.qty")
        ->join("orders_detail",["orders_detail.order_id"=>"orders.id"])
        ->where(["orders_detail.p_id"=>$pid,"orders_detail.attr_id"=>$attr[0]->attr_id])
        ->wherein("orders.order_status",[1,2])
->where(["payment_status"=>"success"])
        ->get();
        $FQ = 0;
        foreach ($finding_orders_qty as $value) {
           $FQ = $FQ+$value->qty;
        }
        // show_arr($FQ);
        // die();
        $avalible_qty = $attr[0]->qty;
        if (count($finding_orders_qty) > 0) {
           $avalible_qty = $attr[0]->qty-$FQ;
        }
        
        echo json_encode(["result"=>$attr,"avalible_qty"=>$avalible_qty]);
    }

    public function add_to_cart(Request $request)
    {
        
        $p_id = $request->p_id;
        $c_id = $request->c_id;
        $s_id = $request->s_id;
        $qty = $request->qty;
        if (session()->has("user_email")) {
            $u_id = session("user_email");
            $u_type = "reg";
         } else {
             if (session()->has("user_temp_id")) {
                 $u_id = session("user_temp_id");
             } else {
                $u_id = rand(111111111,999999999);
                session()->put("user_temp_id",$u_id);
             }
             $u_type = "not_reg";
         }
        
        $attr_id = DB::table("product_attr")
        ->select("attr_id")
        ->where(["product_id"=>$p_id,"size_id"=>$s_id,"color_id"=>$c_id])
        ->where("qty","!=",0)
        ->get()[0]->attr_id;
$i = 0;
$check =  DB::table("cart")
->where(["user_id"=>$u_id,"p_id"=>$p_id,"attr_id"=>$attr_id,"user_id"=>$u_id])
->get();

// show_arr($check) ;
//           die();         
                $product_qty = DB::table("product_attr")
                ->where(["product_attr.attr_id"=>$attr_id])
                ->get()[0]->qty;

                if (isset($check[0])) {
                    // echo "yes";
                    if ($qty == "remove") {
                        DB::table("cart")
                        ->where(["cart_id"=>$check[0]->cart_id])
                        ->delete();
                        $msg = "Deleted"; 
                        $i = 1;
                    }
                }



                if ($i == 0) {
                $finding_orders_qty = DB::table("orders")
        ->select("orders_detail.qty")
        ->join("orders_detail",["orders_detail.order_id"=>"orders.id"])
        ->where(["orders_detail.p_id"=>$p_id,"orders_detail.attr_id"=>$attr_id])
        ->wherein("orders.order_status",[1,2])
->where(["payment_status"=>"success"])
        ->get();
        
        $FQ = 0;
        foreach ($finding_orders_qty as $value) {
           $FQ = $FQ+$value->qty;
        }
        
        if (count($finding_orders_qty) > 0 && $product_qty-$FQ <= 0) {
            echo json_encode(["result"=>"Sorry, This product has been finished in stock"]);
            die();
        } 

        if ($qty > $product_qty-$FQ) {
            echo json_encode(["result"=>"Sorry, Only ".$product_qty-$FQ." are avalible in stock","qty"=>$product_qty-$FQ]);
            die();
        }


        if (isset($check[0])) {
            if ($qty > 0){
               DB::table("cart")
          ->where(["cart_id"=>$check[0]->cart_id])
          ->update(["qty"=>$qty]);
          $msg = "Updated";
            }
         
        } else {
            $at = date("d-Y-M");
            DB::table("cart")
            ->insert(["user_id"=>$u_id,"user_type"=>$u_type,"p_id"=>$p_id,"attr_id"=>$attr_id,"qty"=>$qty,"added_on"=>$at]);
            $msg = "Added";
        } 
    }
        $data = DB::table("cart")
        ->select("products.title","products.p_id","product_attr.color_id","product_attr.size_id","product_attr.price","products.image","cart.qty","color_name","size_name","products.slug")
        ->join("products",["cart.p_id"=>"products.p_id"])
        ->join("product_attr",["cart.attr_id"=>"product_attr.attr_id"])
        ->leftjoin("colors",["product_attr.color_id"=>"colors.id"])
        ->leftjoin("sizes",["product_attr.size_id"=>"sizes.id"])
        ->where(["user_id"=>$u_id,])
        ->get();

        echo json_encode(["result"=>$msg,"data"=>$data]);
    }

     public function cart()
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
        $data["products_in_cart"] = DB::table("cart")
        ->distinct()
        ->select("products.title","products.p_id","product_attr.color_id","product_attr.size_id","product_attr.price","products.image","cart.qty","color_name","size_name","products.slug")
        ->join("products",["cart.p_id"=>"products.p_id"])
        ->join("product_attr",["cart.attr_id"=>"product_attr.attr_id"])
        ->leftjoin("colors",["product_attr.color_id"=>"colors.id"])
        ->leftjoin("sizes",["product_attr.size_id"=>"sizes.id"])
        ->where(["user_id"=>$u_id,])
        ->get();
        
       return view("front.cart",$data);
     }
     // product-details page work end

     // checkout
     public function checkout_show()
{
    if (session()->has("user_email")) {
        $result = DB::table('users')
        ->where(["email"=>session("user_email")])->get();
        $data["name"] = $result[0]->name;
        $data["email"] = $result[0]->email;
        $data["password"] = $result[0]->password;
        $data["mobile"] = $result[0]->mobile;
        $data["address"] = $result[0]->address;
        $data["state"] = $result[0]->state;
        $data["city"] = $result[0]->city;
        $data["zip"] = $result[0]->zip;
    } else {
        $data["name"] = "";
        $data["email"] = "";
        $data["password"] = "";
        $data["mobile"] = "";
        $data["address"] = "";
        $data["state"] = "";
        $data["city"] = "";
        $data["zip"] = "";
    } 

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
    $data["products_in_cart"] = DB::table("cart")
    ->distinct()
    ->select("products.title","products.p_id","product_attr.color_id","product_attr.size_id","product_attr.price","products.image","cart.qty","color_name","size_name","products.slug")
    ->join("products",["cart.p_id"=>"products.p_id"])
    ->join("product_attr",["cart.attr_id"=>"product_attr.attr_id"])
    ->leftjoin("colors",["product_attr.color_id"=>"colors.id"])
    ->leftjoin("sizes",["product_attr.size_id"=>"sizes.id"])
    ->where(["user_id"=>$u_id,])
         ->join("product_attr",["product_attr.product_id"=>"products.p_id"])
         ->where("product_attr.qty","!=",0)
    ->get();

    if (count($data["products_in_cart"]) > 0) {
        return view("front.checkout",$data);
    } else {
        return redirect("/");
    }
}


public function checkout_logic_1(Request $request)
{
    if (session()->has("user_email")) {
        DB::table("users")
        ->where(["email"=>session("user_email")])
        ->update([
            "name"=>$request->fname,
            "mobile"=>$request->phone,
            "address"=>"$request->billing_address",
            "state"=>$request->state,
            "city"=>$request->city,
            "zip"=>$request->zipcode,
            "updated_at"=>date("Y-M-d h:i:s"),
        ]);
        session()->put(["is_email_varify"=>DB::table("users")->where(["email"=>session("user_email")])->get()[0]->email_varify]);
      session()->put(["data"=>$request->all()]);
        echo json_encode(["result"=>"success"]);
    }else{
        
        $is_email_exist = DB::table("users")->where(["email"=>$request->email])->get();
        // return $is_email_exist;
        if (count($is_email_exist) > 0 ) {
            
            echo json_encode(["result"=>"Email ".$request->email." has been already taken, Please try another one or login !"]);
        }else if(count(DB::table("users")->where(["mobile"=>$request->phone])->get()) > 0 ){
            echo json_encode(["result"=>"Mobile number ".$request->phone." has been already taken, Please try another one !"]);
        }else{
            
            DB::table("users")
            ->insert([
                "name"=>$request->fname,
                "mobile"=>$request->phone,
                "email"=>$request->email,
                "address"=>"$request->billing_address",
                "state"=>$request->state,
                "city"=>$request->city,
                "zip"=>$request->zipcode,
                "password"=>$request->password,
                "email_varify"=>0,
                "status"=>1,
                "created_at"=>date("Y-M-d h:i:s"),
                "updated_at"=>date("Y-M-d h:i:s"),
            ]);
             DB::table("cart")->where(["user_id"=>session("user_temp_id")])->update(["user_id"=>$request->email]);
             session()->put("new","yes");
             session()->put("pass",$request->password);
        session()->put("login","yes");
        session()->put("user_email",$request->email);
        session()->put("user_name",$request->fname);
            session()->put(["is_email_varify"=>DB::table("users")->where(["email"=>session("user_email")])->get()[0]->email_varify]);
          session()->put(["data"=>$request->all()]);
            echo json_encode(["result"=>"success"]);
        }
        
    }  
}

public function email_otp(Request $request)
{
    $otp = rand(1111,9999);
    DB::table("users")->where(["email"=>$request->varification_email])->update(["otp"=>$otp]);
    echo json_encode(["result"=>"success","otp"=>$otp]);
}
public function email_varify(Request $request)
{
    $otp = $request->first.$request->second.$request->third.$request->forth;
 
   $is_ok = DB::table("users")->where(["email"=>session("user_email"),"otp"=>$otp])->get();
//    return $is_ok;
if (count($is_ok) > 0) {
    DB::table("users")->where(["email"=>session("user_email")])->update(["email_varify"=>1,"otp"=>0]);
    session()->put(["is_email_varify"=>DB::table("users")->where(["email"=>session("user_email")])->get()[0]->email_varify]);
    
    echo json_encode(["result"=>"success"]);
    
} else {
    echo json_encode(["result"=>"OTP Code Is Not Correct"]);
}
}

public function mobile_otp(Request $request)
{
    // return $request->varification_number;
    $otp = rand(1111,9999);
    DB::table("users")->where(["email"=>session("user_email"),"mobile"=>$request->varification_number])->update(["otp"=>$otp]);
    echo json_encode(["result"=>"success","otp"=>$otp]);
}
public function mobile_varify(Request $request)
{
    $otp = $request->first.$request->second.$request->third.$request->forth;
   $is_ok = DB::table("users")->where(["email"=>session("user_email"),"otp"=>$otp])->get();
if (count($is_ok) > 0) {
     if ($request->payment_option == "COD") {
    $last_inserted_id = DB::table("orders")
    ->insertgetid([
        "user_email"=>session("user_email"),
        "name"=>$request->fname,
        "email"=>session("user_email"),
        "mobile"=>$request->phone,
        "address"=>$request->billing_address,
        "state"=>$request->state,
        "city"=>$request->city,
        "zip"=>$request->zipcode,
        "coupon_code"=>$request->coupon_code,
        "total_price"=>$request->total_price,
        "order_status"=>1,
        "payment_status"=>"success",
        "payment_type"=>$request->payment_option,
        "added_on"=>date("Y-M-d h:i:s")
    ]);
    $cart_items = DB::table("cart")->where(["user_id"=>session("user_email")])->get();
    foreach ($cart_items as $val) {
        DB::table("orders_detail")
        ->insert([
            "order_id"=>$last_inserted_id,
            "p_id"=>$val->p_id,
            "attr_id"=>$val->attr_id,
            "qty"=>$val->qty,
        ]);
        $product_qty = DB::table("product_attr")
    ->where(["product_attr.attr_id"=>$val->attr_id])
    ->get()[0]->qty;

    $finding_orders_qty = DB::table("orders")
->select("orders_detail.qty")
->join("orders_detail",["orders_detail.order_id"=>"orders.id"])
->where(["orders_detail.p_id"=>$val->p_id,"orders_detail.attr_id"=>$val->attr_id,])
->wherein("orders.order_status",[1,2])
->where(["payment_status"=>"success"])
->get();
$FQ = 0;
        foreach ($finding_orders_qty as $value) {
           $FQ = $FQ+$value->qty;
        }
if ($product_qty-$FQ == 0) {
    DB::table("product_attr")
    ->where(["product_attr.attr_id"=>$val->attr_id])
    ->update(["qty"=>0]);
}
    }

    
    
    DB::table("cart")->where(["user_id"=>session("user_email")])->delete();
    session()->forget("data");
    DB::table("users")->where(["email"=>session("user_email")])->update(["otp"=>0]);
    if (session()->has("new")) {
        $new_customer = "yes";
    }else{
        $new_customer="no";
    }
    echo json_encode(["result"=>"success","is_new"=>$new_customer]);
}else{
    echo json_encode(["result"=>"payment gateway is pending"]);
}
} else {
    echo json_encode(["result"=>"OTP Code Is Not Correct"]);
}
}





public function checkout_logic_2(Request $request)
{
    if (session()->has("user_email")) {
        DB::table("users")
        ->where(["email"=>session("user_email")])
        ->update([
            "name"=>$request->fname,
            "mobile"=>$request->phone,
            "address"=>"$request->billing_address",
            "state"=>$request->state,
            "city"=>$request->city,
            "zip"=>$request->zipcode,
            "updated_at"=>date("Y-M-d h:i:s"),
        ]);
         if ($request->payment_option == "COD") {
        $last_inserted_id = DB::table("orders")
        ->insertgetid([
            "user_email"=>session("user_email"),
            "name"=>$request->fname,
            "email"=>$request->email,
            "mobile"=>$request->phone,
            "address"=>$request->billing_address,
            "state"=>$request->state,
            "city"=>$request->city,
            "zip"=>$request->zipcode,
            "coupon_code"=>$request->coupon_code,
            "total_price"=>$request->total_price,
            "order_status"=>1,
            "payment_status"=>"success",
            "payment_type"=>$request->payment_option,
            "added_on"=>date("Y-M-d h:i:s")
        ]);
        $cart_items = DB::table("cart")->where(["user_id"=>session("user_email")])->get();
        foreach ($cart_items as $val) {
            DB::table("orders_detail")
            ->insert([
                "order_id"=>$last_inserted_id,
                "p_id"=>$val->p_id,
                "attr_id"=>$val->attr_id,
                "qty"=>$val->qty,
            ]);
        }
        DB::table("cart")->where(["user_id"=>session("user_email")])->delete();
        echo json_encode(["result"=>"success"]);
    }else{
        echo json_encode(["result"=>"payment gateway is pending"]);
    }
    }else{
        echo json_encode(["result"=>"guest checkout is pending"]);
    }
}
// checkouts page work end

// coupon work start
public function coupon(Request $request)
{
    $exist = DB::table("coupons")->where(["code"=>$request->coupon])->get();
    // return $exist;
    if (count($exist) > 0) {
        if ($exist[0]->status == 1) {
            if ($exist[0]->use_times == 1) {
                echo json_encode(["result"=>"pending"]);
            } else {
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
                $data["products_in_cart"] = DB::table("cart")
                ->distinct()
                ->select("products.title","products.p_id","product_attr.color_id","product_attr.size_id","product_attr.price","products.image","cart.qty","color_name","size_name","products.slug")
                ->join("products",["cart.p_id"=>"products.p_id"])
                ->join("product_attr",["cart.attr_id"=>"product_attr.attr_id"])
                ->leftjoin("colors",["product_attr.color_id"=>"colors.id"])
                ->leftjoin("sizes",["product_attr.size_id"=>"sizes.id"])
                ->where(["user_id"=>$u_id,])
         ->join("product_attr",["product_attr.product_id"=>"products.p_id"])
         ->where("product_attr.qty","!=",0)
                ->get();
$total = 0;
                foreach ($data["products_in_cart"] as $val) {
                    $total = $total+($val->price * $val->qty);
                }
                if ($exist[0]->order_min_amount < $total) {
                    if ($exist[0]->type == "per") {
                     $per = round($exist[0]->value/100*$total);
                     $total = $total - $per;
                    }else{
                        $total = $total - $exist[0]->value;
                    }
                    echo json_encode(["result"=> "success","total"=>$total,"coupon_code"=>$request->coupon]);
                } else {
                    echo json_encode(["result"=>"Sorry, This Coupon Valid For Minimum Order Price ".$exist[0]->order_min_amount.""]);
                }
                
            }
        }else{
            echo json_encode(["result"=>"Sorry, The Coupon ".$request->coupon." Has Been Deactivated"]);
        }
    } else {
        echo json_encode(["result"=>"No Coupon Like ".$request->coupon.""]);
    }
    
}
// coupon work end

// category page work start
     public function category(Request $request, $slug)
     {
      
           $query  =  DB::table("categories")
           ->distinct()
            ->select("products.*","sub_categories.sub_cat_name","sub_categories.id","categories.category_name","categories.category_slug")
            ->join("products",["categories.cat_id"=>"products.cat_id"])
            ->where(["categories.category_slug"=> $slug])
            ->join("product_attr",["products.p_id"=>"product_attr.product_id"])
            ->where("product_attr.qty","!=",0)
            ->join("sub_categories",["products.sub_cat_id"=>"sub_categories.id"]);
           
            if (isset($request->limit) && $request->limit != "") {
         $query = $query->limit($request->limit);
         $data["limit"] = $request->limit;
            }else{
         $data["limit"] = "";
            }
            if (isset($request->sort) && $request->sort != "") {
           if ($request->sort == "featured") {
               $query = $query->where(["is_featured"=> 1]);
           }else if($request->sort == "trending"){
               $query = $query->where(["is_trending"=> 1]);
           }else if($request->sort == "L_to_H"){
            $query = $query->orderby("price","ASC");
           }else if($request->sort == "H_to_L"){
            $query = $query->orderby("price","DESC");
           }else if($request->sort == "latest"){
            $query = $query->orderby("p_id","DESC");
           }
           $data["sort"] = $request->sort;
            }else{
                $data["sort"] = "";
            }
            if ((isset($request->min) && $request->min != "") && (isset($request->max) && $request->max != "") && ($request->min-$request->max != 0)) {
                $query = $query->whereBetween("price",[$request->min,$request->max]);
                $data["min"] = $request->min;
                $data["max"] = $request->max;
            } else {
            $data["min"] = "";
                $data["max"] = "";
            }
            $seperator =[];
            if (isset($request->color_filter) && $request->color_filter != "") {
                $seperator = array_filter(explode("," ,$request->color_filter));
                $query = $query->wherein("color_id",$seperator);
                $data["color_filter"] = $request->color_filter;
            }else{
                $data["color_filter"] = "";
            }
            $query = $query->get();
           
       $data["category_products"] = $query;
       foreach ($data["category_products"] as $value) {
       $query1 = DB::table("product_attr")
       ->leftjoin("colors",["product_attr.color_id"=>"colors.id"])
        ->where(["product_id"=>$value->p_id])
        ->where("product_attr.qty","!=",0)
        ->get();
        foreach ($query1 as $v) {
            $data["color_arr"][$v->color_id] = $v->color_name;
            
        }
        $data["category_products_attr"][$value->p_id] = $query1;
          
       }
      
       if (isset($data["color_arr"])) {
        $data["color_arr"] = array_filter($data["color_arr"]);
      }
       
       foreach ($data["category_products"] as $value) {
        $data["hover_category_products_img"][$value->p_id] = DB::table("product_attr")
        ->where(["product_id"=>$value->p_id])
        ->get()[0]->image;
       }

       $data["new_products"] =  DB::table("products")
       ->distinct()
       ->select("products.*")
         ->join("product_attr",["product_attr.product_id"=>"products.p_id"])
         ->where("product_attr.qty","!=",0)
        ->orderby("p_id","desc")
        ->limit(4)
       ->get();
       foreach ($data["new_products"] as $value) {
        $data["new_products_attr"][$value->p_id] = DB::table("product_attr")
        ->select("price","image")
        ->where(["product_id"=>$value->p_id])
        ->get();
       }

      $data["related_sub_categories"] = DB::table("categories")
      ->select("sub_categories.id","sub_categories.sub_cat_name")
      ->join("sub_categories",["categories.cat_id" => "sub_categories.cat_id"])
      ->where(["categories.category_slug"=>$slug])
      ->get();
    
      $data["exploded_arr"] = $seperator;
       return view("front.category",$data);
     }


// category page work end

// sub_category page work start
public function sub_category(Request $request, $sub_cat_id)
{
   
      $query  =  DB::table("sub_categories")
      ->distinct()
       ->select("products.*","sub_categories.id","sub_categories.sub_cat_name","categories.category_name")
       ->join("products",["sub_categories.id"=>"products.sub_cat_id"])
       ->join("product_attr",["products.p_id"=>"product_attr.product_id"])
       ->where("product_attr.qty","!=",0)
       ->join("categories",["products.cat_id"=>"categories.cat_id"]);
       if (isset($request->limit) && $request->limit != "") {
    $query = $query->limit($request->limit);
    $data["limit"] = $request->limit;
       }else{
    $data["limit"] = "";
       }
       if (isset($request->sort) && $request->sort != "") {
      if ($request->sort == "featured") {
          $query = $query->where(["is_featured"=> 1]);
      }else if($request->sort == "trending"){
          $query = $query->where(["is_trending"=> 1]);
      }else if($request->sort == "L_to_H"){
       $query = $query->orderby("price","ASC");
      }else if($request->sort == "H_to_L"){
       $query = $query->orderby("price","DESC");
      }else if($request->sort == "latest"){
       $query = $query->orderby("p_id","DESC");
      }
      $data["sort"] = $request->sort;
       }else{
           $data["sort"] = "";
       }
       if ((isset($request->min) && $request->min != "") && (isset($request->max) && $request->max != "") && ($request->min-$request->max != 0)) {
           $query = $query->whereBetween("price",[$request->min,$request->max]);
           $data["min"] = $request->min;
           $data["max"] = $request->max;
       } else {
       $data["min"] = "";
           $data["max"] = "";
       }
       $seperator =[];
       if (isset($request->color_filter) && $request->color_filter != "") {
        $seperator = array_filter(explode("," ,$request->color_filter));
        $query = $query->wherein("color_id",$seperator);
        $data["color_filter"] = $request->color_filter;
    }else{
        $data["color_filter"] = "";
    }
        
       $query = $query->where(["sub_categories.id"=> $sub_cat_id])
      ->get();


  $data["sub_category_products"] = $query;
  foreach ($data["sub_category_products"] as $value) {
  $query1 = DB::table("product_attr")
  ->leftjoin("colors",["product_attr.color_id"=>"colors.id"])
  ->where("product_attr.qty","!=",0)
   ->where(["product_id"=>$value->p_id])
   ->get();
   foreach ($query1 as $v) {
       $data["color_arr"][$v->color_id] = $v->color_name;
       
   }
   $data["sub_category_products_attr"][$value->p_id] = $query1;
     
  }
  if (isset($data["color_arr"])) {
    $data["color_arr"] = array_filter($data["color_arr"]);
  }
  
  
  foreach ($data["sub_category_products"] as $value) {
   $data["hover_sub_category_products_img"][$value->p_id] = DB::table("product_attr")
   ->where(["product_id"=>$value->p_id])
   ->get()[0]->image;
  }

  $data["new_products"] =  DB::table("products")
  ->distinct()
  ->select("products.*")
    ->join("product_attr",["product_attr.product_id"=>"products.p_id"])
    ->where("product_attr.qty","!=",0)
   ->orderby("p_id","desc")
   ->where(["sub_cat_id"=>$sub_cat_id])
   ->limit(4)
  ->get();
  foreach ($data["new_products"] as $value) {
   $data["new_products_attr"][$value->p_id] = DB::table("product_attr")
   ->select("price","image")
//    ->where("product_attr.qty","!=",0)
   ->where(["product_id"=>$value->p_id])
   ->get();
  }
  

  $data["related_brands"] =  DB::table("brands")
   ->select("brands.id","brands.brand_name")
   ->join("categories",["brands.cat_id"=>"categories.cat_id"])
   ->join("sub_categories",["categories.cat_id"=>"sub_categories.cat_id"])
   ->where(["sub_categories.id"=>$sub_cat_id])
   ->get();
//    show_arr($data["related_brands"]);
//   die();
  



 $data["exploded_arr"] = $seperator;
  return view("front.sub_category",$data);
}
// sub_category page work end


// shop page work start
public function shop(Request $request)
{
    
   
      $query  =  DB::table("sub_categories")
      ->distinct()
       ->select("products.*","sub_categories.id","sub_categories.sub_cat_name","categories.category_name")
       ->join("products",["sub_categories.id"=>"products.sub_cat_id"])
       ->join("product_attr",["products.p_id"=>"product_attr.product_id"])
       ->where("product_attr.qty","!=",0)
       ->join("categories",["products.cat_id"=>"categories.cat_id"]);
       if (isset($request->limit) && $request->limit != "") {
    $query = $query->limit($request->limit);
       }else{
    $data["limit"] = "";
    $query = $query->limit(8);
       }
       if (isset($request->sort) && $request->sort != "") {
      if ($request->sort == "featured") {
          $query = $query->where(["is_featured"=> 1]);
      }else if($request->sort == "trending"){
          $query = $query->where(["is_trending"=> 1]);
      }else if($request->sort == "L_to_H"){
       $query = $query->orderby("price","ASC");
      }else if($request->sort == "H_to_L"){
       $query = $query->orderby("price","DESC");
      }else if($request->sort == "latest"){
       $query = $query->orderby("p_id","DESC");
      }
      $data["sort"] = $request->sort;
       }else{
           $data["sort"] = "";
       }
       if ((isset($request->min) && $request->min != "") && (isset($request->max) && $request->max != "") && ($request->min-$request->max != 0)) {
           $query = $query->whereBetween("price",[$request->min,$request->max]);
           $data["min"] = $request->min;
           $data["max"] = $request->max;
       } else {
       $data["min"] = "";
           $data["max"] = "";
       }
       $seperator =[];
       if (isset($request->color_filter) && $request->color_filter != "") {
        $seperator = array_filter(explode("," ,$request->color_filter));
        $query = $query->wherein("color_id",$seperator);
        $data["color_filter"] = $request->color_filter;
    }else{
        $data["color_filter"] = "";
    }
    $query = $query->get();
      


  $data["sub_category_products"] = $query;
  foreach ($data["sub_category_products"] as $value) {
  $query1 = DB::table("product_attr")
  ->leftjoin("colors",["product_attr.color_id"=>"colors.id"])
  ->where("product_attr.qty","!=",0)
   ->where(["product_id"=>$value->p_id])
   ->get();
   foreach ($query1 as $v) {
       $data["color_arr"][$v->color_id] = $v->color_name;
       
   }
   $data["sub_category_products_attr"][$value->p_id] = $query1;
     
  }
  if (isset($data["color_arr"])) {
    $data["color_arr"] = array_filter($data["color_arr"]);
  }
  
  
  foreach ($data["sub_category_products"] as $value) {
   $data["hover_sub_category_products_img"][$value->p_id] = DB::table("product_attr")
   ->where(["product_id"=>$value->p_id])
   ->get()[0]->image;
  }

  $data["new_products"] =  DB::table("products")
  ->distinct()
  ->select("products.*")
    ->join("product_attr",["product_attr.product_id"=>"products.p_id"])
    ->where("product_attr.qty","!=",0)
   ->orderby("p_id","desc")
   ->limit(4)
  ->get();
  foreach ($data["new_products"] as $value) {
   $data["new_products_attr"][$value->p_id] = DB::table("product_attr")
   ->select("price","image")
//    ->where("product_attr.qty","!=",0)
   ->where(["product_id"=>$value->p_id])
   ->get();
  }
  
  $data["related_categories"] = DB::table("categories")
  ->select("categories.category_slug","categories.category_name")
  ->join("brands",["categories.cat_id" => "brands.cat_id"])
  ->limit(8)
  ->get();

  $data["related_sub_categories"] = DB::table("categories")
      ->select("sub_categories.id","sub_categories.sub_cat_name")
      ->join("sub_categories",["categories.cat_id" => "sub_categories.cat_id"])
      ->limit(8)
      ->get();
//    show_arr($data["related_brands"]);
//   die();
  

 $data["exploded_arr"] = $seperator;
  return view("front.shop",$data);
}
// shop page work end


// brand page work start
public function brand(Request $request, $barnd_id)
{
   
      $query  =  DB::table("brands")
      ->distinct()
       ->select("products.*","sub_categories.id","sub_categories.sub_cat_name","categories.category_name","brands.brand_name")
       ->join("products",["brands.id"=>"products.brand_id"])
       ->join("sub_categories",["products.sub_cat_id"=>"sub_categories.id"])
       ->join("product_attr",["products.p_id"=>"product_attr.product_id"])
       ->join("categories",["products.cat_id"=>"categories.cat_id"])
       ->where("product_attr.qty","!=",0);
       if (isset($request->limit) && $request->limit != "") {
    $query = $query->limit($request->limit);
    $data["limit"] = $request->limit;
       }else{
    $data["limit"] = "";
       }
       if (isset($request->sort) && $request->sort != "") {
      if ($request->sort == "featured") {
          $query = $query->where(["is_featured"=> 1]);
      }else if($request->sort == "trending"){
          $query = $query->where(["is_trending"=> 1]);
      }else if($request->sort == "L_to_H"){
       $query = $query->orderby("price","ASC");
      }else if($request->sort == "H_to_L"){
       $query = $query->orderby("price","DESC");
      }else if($request->sort == "latest"){
       $query = $query->orderby("p_id","DESC");
      }
      $data["sort"] = $request->sort;
       }else{
           $data["sort"] = "";
       }
       if ((isset($request->min) && $request->min != "") && (isset($request->max) && $request->max != "") && ($request->min-$request->max != 0)) {
           $query = $query->whereBetween("price",[$request->min,$request->max]);
           $data["min"] = $request->min;
           $data["max"] = $request->max;
       } else {
       $data["min"] = "";
           $data["max"] = "";
       }
       $seperator =[];
       if (isset($request->color_filter) && $request->color_filter != "") {
        $seperator = array_filter(explode("," ,$request->color_filter));
        $query = $query->wherein("color_id",$seperator);
        $data["color_filter"] = $request->color_filter;
    }else{
        $data["color_filter"] = "";
    }
        
       $query = $query->where(["brands.id"=> $barnd_id])
      ->get();
    

  $data["brand_products"] = $query;
  foreach ($data["brand_products"] as $value) {
  $query1 = DB::table("product_attr")
  ->leftjoin("colors",["product_attr.color_id"=>"colors.id"])
   ->where(["product_id"=>$value->p_id])
   ->where("product_attr.qty","!=",0)
   ->limit(1)
   ->get();
   
   foreach ($query1 as $v) {
       $data["color_arr"][$v->color_id] = $v->color_name;
   }
   $data["brand_products_attr"][$value->p_id] = $query1;
  }
  if (isset($data["color_arr"])) {
    $data["color_arr"] = array_filter($data["color_arr"]);
  }
//   show_arr($data["brand_products"]);
//   show_arr($data["brand_products_attr"]);
//       die();
  
  foreach ($data["brand_products"] as $value) {
   $data["hover_brand_products_img"][$value->p_id] = DB::table("product_attr")
   ->where(["product_id"=>$value->p_id])
   ->get()[0]->image;
  }

  $data["new_products"] =  DB::table("products")
  ->distinct()
  ->select("products.*")
    ->join("product_attr",["product_attr.product_id"=>"products.p_id"])
    ->where("product_attr.qty","!=",0)
   ->orderby("p_id","desc")
   ->limit(4)
  ->get();
  foreach ($data["new_products"] as $value) {
   $data["new_products_attr"][$value->p_id] = DB::table("product_attr")
   ->select("price","image")
   ->where("product_attr.qty","!=",0)
   ->where(["product_id"=>$value->p_id])
   ->get();
  }

$data["related_categories"] = DB::table("categories")
->select("categories.category_slug","categories.category_name")
->join("brands",["categories.cat_id" => "brands.cat_id"])
->where(["brands.id"=>$barnd_id])
->get();
//    show_arr($data["related_brands"]);
//   die();



 $data["exploded_arr"] = $seperator;
  return view("front.brand",$data);
}
// brand page work end


// Search page work start
public function search(Request $request, $str)
{
//    $attr = DB::table("product_attr") 
// //    ->select("product_attr.product_id")
//    ->groupby("product_id")->get();
// //    show_arr($attr);
// //    die();

    $query  =  DB::table("products")
    ->distinct()
    ->select("products.*","sub_categories.id","sub_categories.sub_cat_name","categories.category_name")
    ->join("categories",["products.cat_id"=>"categories.cat_id"])
    ->join("sub_categories",["products.sub_cat_id"=>"sub_categories.id"])
    ->join("product_attr",["products.p_id"=>"product_attr.product_id"])
    // ->where(["p_id"=>DB::table("product_attr")->get()])
    ->where("attr_id",'=',"" )
       ->where("title",'like','%'.$str.'%' )
       ->orwhere("keywords",'like','%'.$str.'%' )
       ->orwhere("uses",'like','%'.$str.'%' )
       ->orwhere("description",'like','%'.$str.'%' );
       if (isset($request->limit) && $request->limit != "") {
        $query = $query->limit($request->limit);
        $data["limit"] = $request->limit;
           }else{
        $data["limit"] = "";
           }
           if (isset($request->sort) && $request->sort != "") {
          if ($request->sort == "featured") {
              $query = $query->where(["is_featured"=> 1]);
          }else if($request->sort == "trending"){
              $query = $query->where(["is_trending"=> 1]);
          }else if($request->sort == "L_to_H"){
           $query = $query->orderby("price","ASC");
          }else if($request->sort == "H_to_L"){
           $query = $query->orderby("price","DESC");
          }else if($request->sort == "latest"){
           $query = $query->orderby("p_id","DESC");
          }
          $data["sort"] = $request->sort;
           }else{
               $data["sort"] = "";
           }
           $query = $query->get();
           $data["search_products"] = $query;
        //    show_arr($query);
        //    die();


  foreach ($data["search_products"] as $value) {
 $data["search_products_attr"][$value->p_id] = DB::table("product_attr")
  ->leftjoin("colors",["product_attr.color_id"=>"colors.id"])
   ->where(["product_id"=>$value->p_id])
   ->get();
   }

   foreach ($data["search_products"] as $value) {
    $data["hover_search_products_img"][$value->p_id] = DB::table("product_attr")
    ->where(["product_id"=>$value->p_id])
    ->get()[0]->image;
   }
// show_arr($data);
// die();
  return view("front.search",$data);
}
// search page work end


// register page work start
public function register(Request $request)
{
    $date = date("Y-m-d h:i:s");
    $exist = DB::table('users')
    ->where(["email"=>$request->email])->get();
    if (count($exist) > 0) {
        echo json_encode(["result"=>"Email you entered is already given,try another email or login "]);
    }else{
        DB::table("users")->insert(["name"=>$request->name,"email"=>$request->email,"password"=>$request->password,"status"=>1,"created_at"=>$date,"updated_at"=>$date]);
        session()->put("login","yes");
        session()->put("user_email",$request->email);
        session()->put("user_name",$request->name);
        if (session()->has("user_temp_id")) {
            $check_cart = DB::table("cart")->where(["user_id"=>session("user_temp_id")])->get();
            if (count($check_cart) > 0) {
                DB::table("cart")->where(["user_id"=>session("user_temp_id")])->update(["user_id"=>session("user_email")]);
                session()->forget("user_temp_id");
            }
        }
        echo json_encode(["result"=>"success"]);
    }
   
}
// register page work end

// login page work start
public function login(Request $request)
{
    $email_exist = DB::table('users')
    ->where(["email"=>$request->email1])->get();
    $password_exist = DB::table('users')
    ->where(["email"=>$request->email1,"password"=>$request->password1])->get();
    if (count($email_exist) == 0) {
        echo json_encode(["result"=>"Email not mached!"]);
    }else if(count($password_exist) == 0){
        echo json_encode(["result"=>"Password not mached!"]);
    }else{
        session()->put("login","yes");
        session()->put("user_email",$password_exist[0]->email);
        session()->put("user_name",$password_exist[0]->name);
        $check_cart = DB::table("cart")->where(["user_id"=>session("user_temp_id")])->get();
            if (count($check_cart) > 0) {
                DB::table("cart")->where(["user_id"=>"".session('user_temp_id').""])->update(["user_id"=>''.session("user_email").'']);
                session()->forget("user_temp_id");
            }
        echo json_encode(["result"=>"success"]);
    }
}
// login page work end

// register page work start
public function profile()
{
    if (session()->has("user_email")) {
        $result = DB::table('users')
        ->where(["email"=>session("user_email")])->get();
        $data["name"] = $result[0]->name;
        $data["email"] = $result[0]->email;
        $data["password"] = $result[0]->password;
        $data["mobile"] = $result[0]->mobile;
        $data["address"] = $result[0]->address;
        $data["state"] = $result[0]->state;
        $data["city"] = $result[0]->city;
        $data["zip"] = $result[0]->zip;
        return view("front.profile",$data);
    } else {
       return redirect("/");
    } 
}

public function update_profile_show()
{
    if (session()->has("user_email")) {
        $result = DB::table('users')
        ->where(["email"=>session("user_email")])->get();
        $data["name"] = $result[0]->name;
        $data["email"] = $result[0]->email;
        $data["password"] = $result[0]->password;
        $data["mobile"] = $result[0]->mobile;
        $data["address"] = $result[0]->address;
        $data["state"] = $result[0]->state;
        $data["city"] = $result[0]->city;
        $data["zip"] = $result[0]->zip;
        return view("front.update_profile_form",$data);
    } else {
       return redirect("/");
    } 
}

public function update_profile_logic(Request $request)
{
    $date = date("Y-m-d h:i:s");

        DB::table("users")
        ->where(["email"=>DB::table("users")->where(["email"=>$request->email])->get()[0]->email])
        ->update([
            "name"=>$request->name,
            "email"=>$request->email,
            "password"=>$request->password,
            "mobile"=>$request->mobile,
            "address"=>$request->address,
            "state"=>$request->state,
            "city"=>$request->city,
            "status"=>1,
            "updated_at"=>$date
        ]);
        echo json_encode(["result"=>"success"]);
    }
    // register page work end


//myorders
    public function my_orders()
{
    if (session()->has("login")) {
        $data["data"] = DB::table("orders")->where(["email"=>session("user_email")])
        ->select("orders.*","order_status.status")
        ->join("order_status",["order_status.id" => "orders.order_status"])
        ->get();
       return view("front.my_orders",$data);
    } else {
       return redirect("/");
    }
}
public function my_order_details($id)
{
    if (session()->has("login")) {
        $data["data"] = DB::table("orders_detail")
        ->select("products.image","products.slug","coupons.code","product_attr.price as product_price","orders.total_price as af_coupon","orders.address","orders.mobile","orders.city","orders.zip","orders.name","products.title","orders_detail.qty","color_name","size_name")
        ->where(["order_id"=>$id])
        ->join("products",["products.p_id" => "orders_detail.p_id"])
        ->join("orders",["orders.id" => "orders_detail.order_id"])
        ->join("product_attr",["product_attr.attr_id" => "orders_detail.attr_id"])
        ->leftjoin("colors",["colors.id" => "product_attr.color_id"])
        ->leftjoin("sizes",["sizes.id" => "product_attr.size_id"])
        ->leftjoin("coupons","coupons.code","Like","orders.coupon_code")
        ->get();
        // show_arr($data["data"]);
        // die();
       return view("front.my_order_details",$data);
    } else {
       return redirect("/");
    }
}
//myorders 

// add_review start
public function add_review(Request $request)
{
    if ($request->rating == null) {
        echo json_encode(["result"=>"Rating is not select!"]);
    }else{
        DB::table("reviews")->insert([
                "user_id"=>session("user_email"),
                "p_slug"=>$request->p_slug,
                "msg"=>$request->comment,
                "rating"=>$request->rating,
                "status"=>1,
                "date"=>date("Y-m-d h:i:sa"),
        ]);
        echo json_encode(["result"=>"success"]);

    }
}


//wishlist work start
public function add_to_wishlist($p_id,$action)
{
    if ($action == "add") {
        if (count(DB::table("wishlist")->where(["p_id"=>$p_id,"u_email"=>session("user_email")])->get()) > 0) {
            echo json_encode(["result"=>"This product is aleady exist in wishlist"]);
            die();
        }else{
            
            DB::table("wishlist")
            ->insert([
                    "p_id"=>$p_id,
                    "u_email"=>session("user_email"),
                    "date"=>date("Y-m-d h:i:sa"),
            ]);
            $total_count = count(DB::table("wishlist")->where(["u_email"=>session("user_email")])->get());
            echo json_encode(["result"=>"success","total_count"=>$total_count]);
        }
    } else {
        if (count(DB::table("wishlist")->where(["p_id"=>$p_id,"u_email"=>session("user_email")])->get()) > 0) {
            DB::table("wishlist")->where(["p_id"=>$p_id,"u_email"=>session("user_email")])->delete();
            echo json_encode(["result"=>"Deleted"]);
        }
    }
    
   
}

public function wishlist_show()
{
    
   
        $data["products_in_wishlist"] = DB::table("wishlist")
        ->distinct()
       ->select("products.*","wishlist.*")
       ->join("products",["products.p_id"=>"wishlist.p_id"])
         ->join("product_attr",["product_attr.product_id"=>"products.p_id"])
         ->where("product_attr.qty","!=",0)
        ->where(["u_email"=>session("user_email")])->get();

        foreach ($data["products_in_wishlist"] as  $val) {
           
            $data["attr"][$val->p_id] = DB::table("product_attr")->select("color_id","size_id","price")
           ->join("products",["products.p_id"=>"product_attr.product_id"])
             ->where("product_attr.qty","!=",0)
             ->where(["product_attr.product_id"=>$val->p_id])
             ->get();
        }
    // show_arr($data["attr"][86][0]);
    // die();
    return view("front.wishlist",$data);
}
//wishlist work end



}



