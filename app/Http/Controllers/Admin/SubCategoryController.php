<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Admin\Sub_category;
use App\Models\Admin\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubCategoryController extends Controller
{

    public function manage_sub_category_show($id="")
    {
        $data["cat_s"] = Category::all();
          if ($id != "" && $id > 0) {
           $arr[] = Sub_category::find($id);
           $data["url"] = "/admin_penal/sub_category/manage_sub_cat/sub_category_update/".$id;
           $data["cat_id"] = $arr[0]->cat_id;
           $data["sub_cat_name"] = $arr[0]->sub_cat_name;
           $data["btn_val"] = "Update";
           
        }else{
            $data["url"] = "/admin_penal/sub_category/manage_sub_cat/sub_category_insert";
            $data["cat_id"] = "";
           $data["sub_cat_name"] = "";
           $data["btn_val"] = "Add";
        }
        return view("admin.manage_sub_category",$data);
    }

    public function show(Category $cat)
    {
        $data["data"] = $cat->join("sub_categories",["categories.cat_id"=>"sub_categories.cat_id"])->get();
       return view("admin.sub_category",$data);
    }

    public function manage_sub_category_logic(Request $request,$id="")
    {
        if (isset(Sub_category::where(["sub_cat_name"=>$request->sub_cat_name])->get()[0]) ) {
           $id_in_case_of_sub_cat_name = Sub_category::where(["sub_cat_name"=>$request->sub_cat_name ])->get()[0]->id;
        }else{
            $id_in_case_of_sub_cat_name = 0;
        }

        $model_col = new Sub_category();
        if ($request->sub_cat_name == "") {
            session()->flash("error","Sub_category_Name feild is required");
            return redirect()->back();
        }else{
                 $model = Sub_category::all()->toarray();
             foreach ($model as $row) {
            if ($row["sub_cat_name"] == $request->sub_cat_name) {
                if ($request->id != $id_in_case_of_sub_cat_name) {
                    session()->flash("error","Sub_category_name already been taken");
                    return redirect()->back();
                    die();
                }
            }
            }
        }
         
        
        if ($id === "") {
            session()->flash("message","Sub_category added Successfully");
            $model_col->cat_id = $request->post("cat_id");
            $model_col->sub_cat_name = $request->post("sub_cat_name");
        $model_col->status = 1;
        $model_col->save();
        }else{
            session()->flash("message","sub_category updated Successfully");
            //for update
           $model_col = Sub_category::find($request->id);
           $model_col->cat_id = $request->post("cat_id");
            $model_col->sub_cat_name = $request->post("sub_cat_name");
        $model_col->save();
        }
        return redirect("admin_penal/sub_category");
    }


    public function status(Sub_category $sub_category ,$status,$id)
{
  $find = $sub_category->find($id);
//   return $find;
  $find->status = $status;
  $find->save();
  return redirect("admin_penal/sub_category");
}

    public function delete($id)
    {

        $check1 = DB::table("products")->where(["sub_cat_id"=>$id])->get();
        if (count($check1) > 0) {
            session()->flash("error","You can't delete this Sub_category. This Sub_category has ".count($check1)." Product!");
            return redirect()->back();
        }else {
        $model = Sub_category::find($id);
        $model->delete();
        session()->flash("message","Sub_category Deleted Successfully");
        return redirect("admin_penal/Sub_category");
    }
}
}

    

    

