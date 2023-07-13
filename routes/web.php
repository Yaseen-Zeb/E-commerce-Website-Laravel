<?php
//Admin_penal----->>>
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\HomeBannerController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\ReviewsController;
use App\Http\Controllers\Admin\OutOfStockController;

//Front_penal----->>>
use App\Http\Controllers\Front\FrontController;
use Illuminate\Support\Facades\Route;

// app\Http\Controllers\AdminController.php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------

| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// User_penal start

// home page start
Route::get('/',[FrontController::class,"index"]);
// home page end

// shop page start
Route::get('/shop',[FrontController::class,"shop"]);
// shop page end

// about page start
Route::get('/about',function ()
{
  return view("front.about");
});
// about page end

// about page start
Route::get('/contact',function ()
{
  return view("front.contact");
});
// about page end

// product detail page start
Route::get('/product_details/{slug}',[FrontController::class,"product"]);
Route::get('/get_colors/{p_id}/{s_id}',[FrontController::class,"get_colors"]);
Route::get('/get_attr_data/{pid}/{sid}/{cid}',[FrontController::class,"get_attr_data"]);
Route::post('/add_to_cart',[FrontController::class,"add_to_cart"]);
// product detail page end

// cart page start
Route::get("/cart.php",[FrontController::class,"cart"]);
// cart page end

// wishlist work start
Route::get("/add_to_wishlist/{p_id}/{action}",[FrontController::class,"add_to_wishlist"]);
Route::get("/wishlist",[FrontController::class,"wishlist_show"]);

// wishlist work end



// checkout page start
Route::get("/checkout",[FrontController::class,"checkout_show"]);
Route::post("/checkout",[FrontController::class,"checkout_logic_1"]);
// checkout page end

// order_placed page start
Route::get("/order_placed",function ()
{
    if (session()->has("login")) {
        return view("front.order_placed");
    }else{
        return redirect("/");
    }
   
});
// order_placed page end

// varifaction page start
Route::get("/varifaction",function ()
{
    if (session()->has("data")) {
        return view("front.varify");
    }else{
        return redirect("/");
    } 
});
Route::post("/email_otp",[FrontController::class,"email_otp"]);
Route::post("/email_varify",[FrontController::class,"email_varify"]);
Route::post("/mobile_otp",[FrontController::class,"mobile_otp"]);
Route::post("/mobile_varify",[FrontController::class,"mobile_varify"]);
// varifaction page end

//myorders work start
Route::get("/my_orders",[FrontController::class,"my_orders"]);
Route::get("/my_order_details/{id}",[FrontController::class,"my_order_details"]);
//myorders work end

// coupon work start
Route::post("/coupon",[FrontController::class,"coupon"]);
// coupon work end


// category page start
Route::get("/category/{slug}",[FrontController::class,"category"]);
// category page end

// Sub_category page start
Route::get("/sub_category/{id}",[FrontController::class,"sub_category"]);
// Sub_category page end

// Brand page start
Route::get("/brand/{id}",[FrontController::class,"brand"]);
// Brand page end

// Search page start
Route::get("/search/{str}",[FrontController::class,"search"]);
// Search page end

// Registeration page start
Route::get("/register",function ()
{
    if (session()->has("login") == true) {
        return redirect("/profile");
    } else {
         return view("front.register");
    }
});
Route::post("/register",[FrontController::class,"register"]);
// Registeration page end

// thank you page start
Route::get("/thank_you",function ()
{
    if (session()->has("login") == false) {
        return redirect("/index");
    } else {
         return view("front.thanks");
    }
});
// thank you end

// login work start
Route::post("/login",[FrontController::class,"login"]);
// login work end

// logout work start
Route::get("/logout",function ()
{
    if (session()->has("login") == false) {
        return redirect("/index");
    } else {
        session()->forget("login");
        session()->forget("user_name");
        session()->forget("user_email");
        return redirect("/");
    }
});
// logout work end

// profile Page start
Route::get("/profile",[FrontController::class,"profile"]);
// profile Page end

// update_profile Page start
Route::get("/update_profile",[FrontController::class,"update_profile_show"]);
Route::post("/update_profile",[FrontController::class,"update_profile_logic"]);
// update_profile Page end

//Review work start
Route::post("/add_review",[FrontController::class,"add_review"]);
//Review work end



// User_penal end



//Admin_penal---->>>
Route::get("admin_penal",[AdminController::class,"index"]);
Route::post("admin_penal/dashboard",[AdminController::class,"admin_login"]);
Route::get("admin_penal/logout",[AdminController::class,"admin_logout"]);

//middleware admin_login start
Route::group(["middleware"=>"admin_login"],function (){
Route::get("admin_penal/dashboard",function (){return view("admin.dashboard");});
//category Routes start
Route::get("admin_penal/category",[CategoryController::class,"show"]);
Route::get("admin_penal/category/manage_cat",[CategoryController::class,"manage_category_show"]);
Route::get("admin_penal/category/manage_cat/{id}",[CategoryController::class,"manage_category_show"]);
Route::post("admin_penal/category/manage_cat/category_insert",[CategoryController::class,"manage_category_logic"]);
Route::post("admin_penal/category/manage_cat/category_update/{id}",[CategoryController::class,"manage_category_logic"]);
Route::get("admin_penal/category/manage_cat/status/{status}/{id}",[CategoryController::class,"status"]);
Route::get("admin_penal/category/delete/{id}",[CategoryController::class,"delete"]);
//category Routes end

//Home Banner Routes start
Route::get("admin_penal/home_banner",[HomeBannerController::class,"show"]);
Route::get("admin_penal/home_banner/manage_home_banner",[HomeBannerController::class,"manage_home_banner_show"]);
Route::get("admin_penal/home_banner/manage_home_banner/{id}",[HomeBannerController::class,"manage_home_banner_show"]);
Route::post("admin_penal/home_banner/manage_home_banner/home_banner_insert",[HomeBannerController::class,"manage_home_banner_logic"]);
Route::post("admin_penal/home_banner/manage_home_banner/home_banner_update/{id}",[HomeBannerController::class,"manage_home_banner_logic"]);
Route::get("admin_penal/home_banner/manage_home_banner/status/{status}/{id}",[HomeBannerController::class,"status"]);
Route::get("admin_penal/home_banner/delete/{id}",[HomeBannerController::class,"delete"]);
//Home Banner Routes end

//sub_category Routes start
Route::get("admin_penal/sub_category",[SubCategoryController::class,"show"]);
Route::get("admin_penal/sub_category/manage_sub_cat",[SubCategoryController::class,"manage_sub_category_show"]);
Route::get("admin_penal/sub_category/manage_sub_cat/{id}",[SubCategoryController::class,"manage_sub_category_show"]);
Route::post("admin_penal/sub_category/manage_sub_cat/sub_category_insert",[SubCategoryController::class,"manage_sub_category_logic"]);
Route::post("admin_penal/sub_category/manage_sub_cat/sub_category_update/{id}",[SubCategoryController::class,"manage_sub_category_logic"]);
Route::get("admin_penal/sub_category/manage_sub_cat/status/{status}/{id}",[SubCategoryController::class,"status"]);
Route::get("admin_penal/sub_category/delete/{id}",[SubCategoryController::class,"delete"]);
//sub_category Routes end

//Brand Routes start
Route::get("admin_penal/brand",[BrandController::class,"show"]);
Route::get("admin_penal/brand/manage_brand",[BrandController::class,"manage_brand_show"]);
Route::get("admin_penal/brand/manage_brand/{id}",[BrandController::class,"manage_brand_show"]);
Route::post("admin_penal/brand/manage_brand/brand_insert",[BrandController::class,"manage_brand_logic"]);
Route::post("admin_penal/brand/manage_brand/brand_update/{id}",[BrandController::class,"manage_brand_logic"]);
Route::get("admin_penal/brand/manage_brand/status/{status}/{id}",[BrandController::class,"status"]);
Route::get("admin_penal/brand/delete/{id}",[BrandController::class,"delete"]);
//Brand Routes end

//Coupon Routes start
Route::get("admin_penal/coupon",[CouponController::class,"show"]);
Route::get("admin_penal/coupon/manage_coupon",[CouponController::class,"manage_coupon_show"]);
Route::get("admin_penal/coupon/manage_coupon/{id}",[CouponController::class,"manage_coupon_show"]);
Route::post("/admin_penal/coupon/manage_coupon/insert",[CouponController::class,"manage_coupon_logic"]);
Route::post("/admin_penal/coupon/manage_coupon/update/{id}",[CouponController::class,"manage_coupon_logic"]);
Route::get("/admin_penal/coupon/manage_coupon/status/{status}/{id}",[CouponController::class,"status"]);
Route::get("/admin_penal/coupon/manage_coupon/delete/{id}",[CouponController::class,"delete"]);
//Coupon Routes end

//Size Routes start
Route::get("admin_penal/size",[SizeController::class,"show"]);
Route::get("admin_penal/size/manage_size",[SizeController::class,"manage_size_show"]);
Route::get("admin_penal/size/manage_size/{id}",[SizeController::class,"manage_size_show"]);
Route::post("/admin_penal/size/manage_size/insert",[SizeController::class,"manage_size_logic"]);
Route::post("/admin_penal/size/manage_size/update/{id}",[SizeController::class,"manage_size_logic"]);
Route::get("/admin_penal/size/manage_size/status/{status}/{id}",[SizeController::class,"status"]);
Route::get("/admin_penal/size/manage_size/delete/{id}",[SizeController::class,"delete"]);
//Size Routes end

//Color Routes start
Route::get("admin_penal/color",[ColorController::class,"show"]);
Route::get("admin_penal/color/manage_color",[ColorController::class,"manage_color_show"]);
Route::get("admin_penal/color/manage_color/{id}",[ColorController::class,"manage_color_show"]);
Route::post("/admin_penal/color/manage_color/insert",[ColorController::class,"manage_color_logic"]);
Route::post("/admin_penal/color/manage_color/update/{id}",[ColorController::class,"manage_color_logic"]);
Route::get("/admin_penal/color/manage_color/status/{status}/{id}",[ColorController::class,"status"]);
Route::get("/admin_penal/color/manage_color/delete/{id}",[ColorController::class,"delete"]);
//Color Routes end


//product Routes start
Route::get("admin_penal/product/manage_product/get_options/{cat_id}",[ProductController::class,"get_options"]);
Route::get("admin_penal/product",[ProductController::class,"show"]);
Route::get("admin_penal/product/manage_product",[ProductController::class,"manage_product_show"]);
Route::get("admin_penal/product/manage_product/{id}/{cat_id}/{sub_cat_id}/{brand_id}",[ProductController::class,"manage_product_show"]);
Route::post("/admin_penal/product/manage_product/insert",[ProductController::class,"manage_product_logic"]);
Route::post("/admin_penal/product/manage_product/update/{id}",[ProductController::class,"manage_product_logic"]);
Route::get("/admin_penal/product/manage_product/status/{status}/{id}",[ProductController::class,"status"]);
Route::get("/admin_penal/product/manage_product/delete/{id}",[ProductController::class,"delete"]);
Route::get("/admin_penal/product/manage_product/delete_attr/{id}",[ProductController::class,"attr_delete"]);
Route::get("/admin_penal/product/manage_product/delete_multi_image/{id}",[ProductController::class,"delete_multi_image"]);
//product Routes end

// out_of_stock start
Route::get("/admin_penal/out_of_stock",[OutOfStockController::class,"out_of_stock"]);
// out_of_stock end

//Orders Routes start
Route::get("admin_penal/orders",[OrdersController::class,"show"]);
Route::get("admin_penal/order_details/{id}",[OrdersController::class,"details"]);
Route::get("admin_penal/update_order_status/{status}/{order_id}",[OrdersController::class,"update_order_status"]);
//Orders Routes end

//Orders Routes start
Route::get("admin_penal/reviews",[ReviewsController::class,"reviews_show"]);
Route::get("/admin_penal/reviews/status/{status}/{review_id}",[ReviewsController::class,"status"]);
//Orders Routes end
})
//middleware admin_login end



?>