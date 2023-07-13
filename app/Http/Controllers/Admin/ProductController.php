<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use App\Models\Admin\Coupon;
use App\Models\Admin\Category;
use App\Models\Admin\Product_attribute;
use Illuminate\Http\Request;
use Storage;
// use Illuminate\Support\Facades\Request ;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    public function show()
    {

    
    
       $data["data"] =DB::table("products")
       ->distinct()
       ->select("products.*")
       ->join("product_attr",["product_attr.product_id"=>"products.p_id"])
       ->where("product_attr.qty","!=",0)
       ->get();
       return view("admin.product",$data);

    }

   
    public function manage_product_show(Product $product,$id = "",$cat_id='',$scat_id="",$b_id="")
    {
      $data["multi_imgs"] = DB::table("product_images")->where(["p_id"=>$id])->get();
      $data["sub_cat"] = DB::table("sub_categories")->where(["cat_id"=>$cat_id])->get();
      $data["brand"] = DB::table("brands")->where(["cat_id"=>$cat_id])->get();
       $data["cat_s"] =  Category::where(["status"=>1])->get();
       $data["attr"] =  Product_attribute::where(["product_id"=>$id])->get();
       $data["color_options"] = DB::table("colors")->get();
       $data["size_options"] = DB::table("sizes")->get();
        if ($id != "" && $id > 0) {
        $arr[] = $product->where(["p_id"=>$id])->get()[0];
        $data["url"] = "/admin_penal/product/manage_product/update/".$id;
        $data["title"] = $arr[0]->title;
        $data["image"] = $arr[0]->image;
        $data["slug"] = $arr[0]->slug;
        $data["cat_id"] = $arr[0]->cat_id;
        $data["sub_cat_id"] = $arr[0]->sub_cat_id;
        $data["brand_id"] = $arr[0]->brand_id;
        $data["uses"] = $arr[0]->uses;
        $data["keywords"] = $arr[0]->keywords;
        $data["description"] = $arr[0]->description;
        $data["lead_time"] = $arr[0]->lead_time;
        $data["tax"] = $arr[0]->tax;
        $data["tax_type"] = $arr[0]->tax_type;
        $data["is_promo"] = $arr[0]->is_promo;
        $data["is_featured"] = $arr[0]->is_featured;
        $data["is_discounted"] = $arr[0]->is_discounted;
        $data["is_trending"] = $arr[0]->is_trending;
        $data["btn_val"] = "Update";
        } else {
            $data["url"] = "/admin_penal/product/manage_product/insert";
            $data["title"] = "";
            $data["slug"] = "";
            $data["cat_id"] = "";
            $data["sub_cat_id"] = "";
            $data["brand_id"] = "";
            $data["uses"] = "";
            $data["keywords"] = "";
            $data["description"] = "";
            $data["image"] = "";
            $data["lead_time"] = "";
            $data["tax"] = "";
            $data["tax_type"] = "";
            $data["is_promo"] ="";
            $data["is_featured"] = "";
            $data["is_discounted"] ="";
            $data["is_trending"] = "";
            $data["add"] = "";
          $data["btn_val"] = "Add";
        }
        return view("admin.manage_product",$data);
    }

    public function manage_product_logic(Request $request,Product $product,Product_attribute $p_attr,$id="")
    {

      if ($request->brand_id == "") {
        $request->brand_id = 0;
      }
      

        if (isset($product->where(["slug"=>$request->slug])->get()[0])) {
           $id_in_case_of_product_slug = $product->where(["slug"=>$request->slug])->get()[0]->p_id;
        }else{
            $id_in_case_of_product_slug = 0;
        }

 

        if ($request->hasfile("image")) {
            $file = $request->file("image");
            $ext = $file->extension();
            if ($ext == "png" || $ext == "jpg" || $ext=="jpeg" || $ext == "webp") {
               $image_name = time()."-.".$ext;
               $file->storeAs("/public/images",$image_name);
               if ($id !== "") {
                $find = $product->where(["p_id" =>$id])->get()[0];
                if (Storage::exists('app/public/images/'.$find->image)) {
                  Storage::delete("app/public/images/".$find->image);
                }
                DB::table("products")->where(["p_id"=>$id])->update(["image"=>$image_name]);
               }else{
                $product->image = $image_name;
               }
            }else{
                session()->flash("error","Please Select jpg, png, jpeg Formate file");
                return redirect()->back();
            }
        }


        foreach ($product->all() as $value) {
          if ($value->slug == $request->slug) {
            if ($id != $id_in_case_of_product_slug) {
            session()->flash("error","Product_Slug is already been taken");
            return redirect()->back();
        }
          }
        }


            if ($id != "") {
              
                $find = $product->where(["p_id"=>$id])->get()[0];
        DB::table("products")->where(["p_id"=>$id])->update(["title"=>$request->title,"slug"=>$request->slug,"cat_id"=>$request->category,"sub_cat_id"=>$request->sub_cat_id,"uses"=>$request->uses,"keywords"=>$request->keywords,"description"=>$request->description,"lead_time"=>$request->lead_time,"tax"=>$request->tax,"tax_type"=>$request->tax_type,"is_promo"=>$request->is_promo,"is_featured"=>$request->is_featured,"is_discounted"=>$request->is_discounted,"is_trending"=>$request->is_trending]);

        $p_id = DB::table("products")->where(["p_id"=>$id])->get()[0]->p_id;

        session()->flash("message","product Updated seccessfully");
             }else{
                
                $product->title = $request->title;
                $product->image = $image_name;
                $product->slug = $request->slug;
                $product->cat_id = $request->category;
                $product->sub_cat_id = $request->sub_cat_id;
                $product->brand_id = $request->brand_id;
                $product->uses = $request->uses;
                $product->keywords = $request->keywords;
                $product->description = $request->description;
                $product->lead_time = $request->lead_time;
                $product->tax = $request->tax;
                $product->tax_type = $request->tax_type;
                $product->is_promo = $request->is_promo;
                $product->is_featured = $request->is_featured;
                $product->is_discounted = $request->is_discounted;
                $product->is_trending = $request->is_trending;
                $product->status = 1;
                $product->save();
                $p_id = $product->id;
                // return $product;

             } 
    //  // multiple images logic start
    if (isset($request->forimages[0]) ) {
      foreach ($request->forimages as $key => $value) {
        if (isset($request->images[$key])) {
          $multi_img = $request->images[$key];
          $img_ext = $multi_img->extension();
          if ($img_ext == "jpg" || $img_ext == "jpeg" || $img_ext == "png" || $img_ext == "webp"){
           $multi_img_name = time().rand(111111,999999)."_.". $multi_img->extension();
          }else{
            session()->flash("error","Please Select jpg, png, jpeg Formate file");
            return redirect()->back();
          }
          
        }
      if ($id !== "") {
        if (isset($request->for_update[$key])) {
          if (isset($request->images[$key])) {
          $find = DB::table("product_images")->where(["img_id"=>$request->for_update[$key]])->get();
          if (Storage::exists('app/public/images/'.$find[0]->image)) {
            Storage::delete("app/app/public/images/".$find[0]->image);
          }
       $multi_img->storeAs("public/images/",$multi_img_name);
       DB::table("product_images")->where(["img_id"=>$request->for_update[$key]])->update(["p_id"=>$p_id,"image"=>$multi_img_name]);
          }
        }else{
          $multi_img->storeAs("public/images/",$multi_img_name);
          DB::table("product_images")->insert(["p_id"=>$id,"image"=>$multi_img_name]);
        }
      }else{
       $multi_img->storeAs("public/images/",$multi_img_name);
       DB::table("product_images")->insert(["p_id"=>$p_id,"image"=>$multi_img_name]);
      }
    }
    }
    // // multiple images logic end


// atttributes logic start
foreach ($request->sku as $key => $value) {
   //unique sku start
 foreach ($p_attr->all() as $value) {
  if ($value->sku == $request->sku[$key]) {
    if (isset($request->update_condition[$key]) ) {
      if ($value->attr_id != $request->update_condition[$key]) {
       session()->flash("error","Product_Sku is already been taken");
    return redirect()->back();
      }
}else{
  session()->flash("error","Product_Sku is already been taken");
  return redirect()->back();
}
  }
}
//unique sku end

$img_name = null;
  //image start
if (isset($request->attr_images[$key])) {
  $img = $request->file("attr_images")[$key];
  $img_ext = $img->extension();
  if ($img_ext == "jpg" || $img_ext == "jpeg" ||  $img_ext == "png" ||  $img_ext == "webp" ) { 
    $img_name = time().rand(11111111,99999999).".".$img_ext;
    if (isset($request->update_condition[$key])) {
     $related_row = $p_attr->where(["attr_id"=>$request->update_condition[$key]])->get();
     if (Storage::exists('app/public/images/').$related_row[0]->image) {
      Storage::delete('app/public/images/').$related_row[0]->image;
    }
      
       $img->storeAs("/public/images",$img_name);
    }else{
   $img->storeAs("/public/images",$img_name);
    }
  }else{
    session()->flash("error","Please Select jpg, png, jpeg Formate file");
    return redirect()->back();
  }
}
//img end

if (isset($request->color[$key])) {
 $request_C = $request->color[$key];
}else{
  $request_C = 0;
}

if (isset($request->size[$key])) {
 $request_S = $request->size[$key];
}else{
  $request_S = 0;
}


 if ($id !== "") {
    if (isset($request->update_condition[$key])) {
     if (!isset($img_name) ) {
        DB::table("product_attr")->where(["attr_id"=>$request->update_condition[$key]])->update(["sku"=>$request->sku[$key],"color_id"=>$request_C,"size_id"=>$request_S,"mrp"=>$request->mrp[$key],"price"=>$request->price[$key],"qty"=>$request->qty[$key]]);
     }else{
      DB::table("product_attr")->where(["attr_id"=>$request->update_condition[$key]])->update(["sku"=>$request->sku[$key],"color_id"=>$request_C,"size_id"=>$request_S,"mrp"=>$request->mrp[$key],"price"=>$request->price[$key],"qty"=>$request->qty[$key],"image"=>$img_name]);
     }
 
   session()->flash("message","product updated seccessfully");
    }else{
      DB::table("product_attr")->insert(["product_id"=>$p_id,"sku"=>$request->sku[$key],"color_id"=>$request_C,"size_id"=>$request_S,"mrp"=>$request->mrp[$key],"price"=>$request->price[$key],"qty"=>$request->qty[$key],"image"=>$img_name]);
      session()->flash("message","product updated seccessfully");
    }
    
  }else{ 
    DB::table("product_attr")->insert(["product_id"=>$p_id,"sku"=>$request->sku[$key],"color_id"=>$request_C,"size_id"=>$request_S,"mrp"=>$request->mrp[$key],"price"=>$request->price[$key],"qty"=>$request->qty[$key],"image"=>$img_name]);
    session()->flash("message","product added seccessfully");
  }

  }
  // atttributes logic end

      return redirect("/admin_penal/product");
        }

        public function status(Product $product,$status,$id)
        {
          DB::table("products")->where(["p_id"=>$id])->update(['status'=>$status]);
           return redirect("/admin_penal/product");
        }


        public function delete(Product $product ,$id)
        {
       $find = $product->where(["p_id"=>$id])->get()[0];
      //  return $find;
      if (Storage::exists('app/public/images/'.$find->image)) {
        Storage::delete("app/public/images/".$find->image);
      }
         DB::table("products")->where(["p_id"=>$id])->delete();
           session()->flash("message","Product deleted seccessfully");
           return redirect("/admin_penal/product");
        }

        public function attr_delete(Product_attribute $p_a ,$id)
        {
         $find = $p_a->where(["attr_id"=>$id])->get();
       DB::table('product_attr')->where(["attr_id"=>$id])->delete();
         if (Storage::exists('app/public/images/'.$find[0]->image)) {
          Storage::delete("app/public/images/".$find[0]->image);
        }
           return redirect()->back();
        
        }

        public function delete_multi_image(Product_attribute $p_a ,$id)
        {
        $find = DB::table("product_images")->where(["img_id"=>$id])->get();
      
       if (Storage::exists('app/public/images/'.$find[0]->image)) {
        Storage::delete("app/public/images/".$find[0]->image);
      }
       DB::table('product_images')->where(["img_id"=>$id])->delete();
           return redirect()->back();
        
        }

        public function get_options(Category $category,$cat_id)
        {
        
       $data["sub"]= DB::table("sub_categories")->where(["cat_id"=>$cat_id])->get();
       $data["brand"] = DB::table("brands")->where(["cat_id"=>$cat_id])->get();
        echo json_encode(["result" => $data]);
        }



}
