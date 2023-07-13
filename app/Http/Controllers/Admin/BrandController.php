<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Brand;
use App\Models\Admin\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;
class BrandController extends Controller
{
    public function manage_brand_show($id="")
    {
        $data["cat_s"] = Category::all();
          if ($id != "" && $id > 0) {
           $arr[] = Brand::find($id);
        //    return $arr;
           $data["url"] = "/admin_penal/brand/manage_brand/brand_update/".$id;
           $data["cat_id"] = $arr[0]->cat_id;
           $data["brand_name"] = $arr[0]->brand_name;
           $data["image"] = $arr[0]->image;
           if ($arr[0]->home_show == 1) {
            $data["check"] =  "checked";
           }else{
            $data["check"] =  "";
           }
           $data["btn_val"] = "Update";
           
        }else{
            $data["url"] = "/admin_penal/brand/manage_brand/brand_insert";
            $data["cat_id"] = "";
           $data["brand_name"] = "";
           $data["image"] = "";
           $data["check"] =  "";
           $data["btn_val"] = "Add";
        }
        return view("admin.manage_brand",$data);
    }

    public function show(Brand $brand)
    {
        $data["data"] = $brand->leftjoin("categories",["brands.cat_id"=>"categories.cat_id"])->get();
        // return $data;
       return view("admin.brand",$data);
    }

    public function manage_brand_logic (Request $request,$id="")
    {
        if (isset(Brand::where(["brand_name"=>$request->brand_name])->get()[0]) ) {
           $id_in_case_of_brand_name = brand::where(["brand_name"=>$request->brand_name ])->get()[0]->id;
        }else{
            $id_in_case_of_brand_name = 0;
        }

        $model_col = new Brand();
        if ($request->brand_name == "") {
            session()->flash("error","brand_Name feild is required");
            return redirect()->back();
        }else{
                 $model = Brand::all()->toarray();
             foreach ($model as $row) {
            if ($row["brand_name"] == $request->brand_name) {
                if ($request->id != $id_in_case_of_brand_name) {
                    session()->flash("error","brand_name already been taken");
                    return redirect()->back();
                    die();
                }
            }
            }
        }

        if (isset($request->image)) {
            $image =  $request->file("image");
            $ext = $image->extension();
            if ($ext == "jpg" || $ext == "png" || $ext == "jpeg") {
                if ($id !== "") {
                   $find = Brand::find($id);
                   if (Storage::exists("public/images/brand/".$find->image)) {
                    Storage::delete("public/images/brand/".$find->image);
                   }
                }
             $image_name = time()."_.".$ext;
             $image->storeAs("public/images/brand/",$image_name);
            }
          }

          if (!isset($request->home_check)) {
            $request->home_check = 0;
          }
         
        
          if ($id === "") {
            session()->flash("message","Brand added Successfully");
            if (isset($image_name)) {
               $model_col->brand_name = $request->post("brand_name");
               $model_col->cat_id = $request->post("cat_id");
        $model_col->home_show = $request->home_check;
        $model_col->image= $image_name;
        $model_col->status = 1;
        $model_col->save();
            }else{
                $model_col->brand_name = $request->post("brand_name");
                $model_col->cat_id = $request->post("cat_id");
                $model_col->home_show = $request->home_check;
                $model_col->status = 1;
                $model_col->save();
            }
           
        }else{
            session()->flash("message","Brand updated Successfully");
            //for update
            if (isset($image_name)) {
                $model_col = Brand::find($request->id);
                $model_col->brand_name = $request->post("brand_name");
                $model_col->cat_id = $request->post("cat_id");
            $model_col->image= $image_name;
            $model_col->home_show = $request->home_check;
            $model_col->save();
            }else{
            $model_col = Brand::find($request->id);
            $model_col->brand_name = $request->post("brand_name");
            $model_col->cat_id = $request->post("cat_id");
            $model_col->home_show = $request->home_check;
            $model_col->save();
            }
           
        }
        return redirect("admin_penal/brand");
    }


    public function status(Brand $brand ,$status,$id)
{
  $find = $brand->find($id);
  $find->status = $status;
  $find->save();
  return redirect("admin_penal/brand");
}

    public function delete($id)
    {
        $check1 = DB::table("products")->where(["brand_id"=>$id])->get();
        if (count($check1) > 0) {
            session()->flash("error","You can't delete this Brand. This Brand has ".count($check1)." Product!");
            return redirect()->back();
        }else {
        $model = Brand::find($id);
        $model->delete();
        session()->flash("message","brand Deleted Successfully");
        return redirect("admin_penal/brand");
    }

    }
}
