<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Admin\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;

class CategoryController extends Controller
{
    public function manage_category_show($id="")
    {
          if ($id != "" && $id > 0) {
           $arr[] = Category::where(["cat_id"=>$id])->get()[0];
           
           $data["url"] = "/admin_penal/category/manage_cat/category_update/".$id;
           $data["cat_name"] = $arr[0]->category_name;
           $data["slug_name"] = $arr[0]->category_slug;
           $data["image"] = $arr[0]->image;
           if ($arr[0]->home_show == 1) {
            $data["home_check"] =  "checked";
           }else{
            $data["home_check"] =  "";
           }
           if ($arr[0]->our_collection == 1) {
            $data["collection_check"] =  "checked";
           }else{
            $data["collection_check"] =  "";
           }
           $data["btn_val"] = "Update";
           
        }else{
            $data["url"] = "/admin_penal/category/manage_cat/category_insert";
            $data["cat_name"] = "";
           $data["slug_name"] = "";
           $data["image"] = "";
           $data["home_check"] =  "";
           $data["collection_check"] =  "";
           $data["btn_val"] = "Add";
        }
        return view("admin.manage_category",$data);
    }

    public function show()
    {
        $data["data"] = Category::all();
       return view("admin.category",$data);
    }

    public function manage_category_logic(Request $request,$id="")
    {
       
        if (isset(Category::where(["category_name"=>$request->CategoryName])->get()[0])) {
           $id_in_case_of_cat_name = Category::where(["category_name"=>$request->CategoryName])->get()[0]->cat_id;
        }else{
            $id_in_case_of_cat_name = 0;
        }

        if (isset(Category::where(["category_slug"=>$request->CategorySlug])->get()[0]) ) {
           $id_in_case_of_cat_slug = Category::where(["category_slug"=>$request->CategorySlug])->get()[0]->cat_id;
        }else{
            $id_in_case_of_cat_slug = 0;
        }

        $model_col = new Category;
        if ($request->CategoryName == "") {
            session()->flash("error","Category_Name feild is required");
            return redirect()->back();
        }else if ($request->CategorySlug == "") {
            session()->flash("error","Category_Slug feild is required");
            return redirect()->back();
        }else{
                 $model = Category::all()->toarray();
             foreach ($model as $row) {
            if ($row["category_name"] == $request->CategoryName) {
                if ($request->id != $id_in_case_of_cat_name) {
                    session()->flash("error","Category_name already been taken");
                    return redirect()->back();
                    die();
                }
            }

                if ($row["category_slug"] == $request->CategorySlug) {
                    if ($request->id != $id_in_case_of_cat_slug) {
                        session()->flash("error","Category_slug already been taken");
                        return redirect()->back();
                        die();
                    }
                }
            }
            
            if (isset($request->image)) {
                $image =  $request->file("image");
                $ext = $image->extension();
                if ($ext == "jpg" || $ext == "png" || $ext == "jpeg") {
                    if ($id !== "") {
                       $find = Category::where(["cat_id"=>$id])->get()[0];
                       if ( Storage::exists("public/images/category/".$find->image)) {
                        Storage::delete("public/images/category/".$find->image);
                       }
                    }
                 $image_name = time()."_.".$ext;
                 $image->storeAs("public/images/category/",$image_name);
                }else{
                    session()->flash("error","Plaese Select jpg, jpeg, or png formate image");
                    return redirect()->back();
                }
              }

              if (!isset($request->home_check)) {
                $request->home_check = 0;
              }
              if (!isset($request->collection_check)) {
                $request->collection_check = 0;
              }
        
        if ($id === "") {
            session()->flash("message","Category added Successfully");
            
                $find = DB::table("categories")->insert(["category_name"=>$request->CategoryName,"category_slug"=>$request->CategorySlug,"image"=>$image_name,"home_show"=>$request->home_check,"our_collection"=>$request->collection_check,"status"=>1]);
        }else{
            session()->flash("message","Category updated Successfully");
            //for update
            if (isset($image_name)) {
               $find = DB::table("categories")->where(["cat_id"=>$id])->update(["category_name"=>$request->CategoryName,"category_slug"=>$request->CategorySlug,"image"=>$image_name,"home_show"=>$request->home_check,"our_collection"=>$request->collection_check]);
            }else{
                $find = DB::table("categories")->where(["cat_id"=>$id])->update(["category_name"=>$request->CategoryName,"category_slug"=>$request->CategorySlug,"home_show"=>$request->home_check,"our_collection"=>$request->collection_check]);
            }
           
        }
        return redirect("admin_penal/category");
    }
}
    
public function status(Category $category ,$status,$id)
{
    $find = DB::table("categories")->where(["cat_id"=>$id])->update(["status"=>$status]);
  return redirect("admin_penal/category");
}

    public function delete($id)
    {
        $check1 = DB::table("sub_categories")->where(["cat_id"=>$id])->get();
        $check2 = DB::table("brands")->where(["cat_id"=>$id])->get();
        if (count($check1) > 0) {
            session()->flash("error","You can't delete this category, This category has ".count($check1)." Sub_category!");
            return redirect()->back();
        }else if (count($check2) > 0) {
            session()->flash("error","You can't delete this category, This category has ".count($check2)." Brand!");
            return redirect()->back();
        }else {
            $find = DB::table("categories")->where(["cat_id"=>$id])->delete();
        session()->flash("message","Category Deleted Successfully");
        return redirect("admin_penal/category");
        }
         
       
    }
    
    
}





