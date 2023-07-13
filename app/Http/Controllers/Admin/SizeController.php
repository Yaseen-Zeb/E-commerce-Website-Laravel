<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function show()
    {
       $data["data"] = Size::all();
       return view("admin.size",$data);
    }

   
    public function manage_size_show(Size $size,$id = "")
    {
        if ($id != "" && $id > 0) {
        $arr[] = $size->find($id);
        $data["url"] = "/admin_penal/size/manage_size/update/".$id;
        $data["size_name"] = $arr[0]->size_name;
        $data["btn_val"] = "Update";
        } else {
            $data["url"] = "/admin_penal/size/manage_size/insert";
          $data["size_name"] = "";
          $data["btn_val"] = "Add";
        }
        return view("admin.manage_size",$data);
    }

    public function manage_size_logic(Request $request,Size $size,$id="")
    {
        if (isset($size->where(["size_name"=>$request->size_name])->get()[0])) {
           $id_in_case_of__sizeName = $size->where(["size_name"=>$request->size_name])->get()[0]->id;
        }else{
            $id_in_case_of__sizeName = 0;
        }

            foreach ($size->all() as $value) {
              if ($value->size_name == $request->size_name) {
                if ($id != $id_in_case_of__sizeName) {
                session()->flash("error","Size_name is already been taken");
                return redirect()->back();
            }
              }
            }

            if ($id !== "") {
                $find = $size->find($id);
        $find->size_name = $request->size_name;
       $find->save();
        session()->flash("message","Size Updated seccessfully");
             }else{
       $size->size_name = $request->size_name;
       $size->status = 1;
       $size->save();
       session()->flash("message","Size added seccessfully");
             } 
             return redirect("/admin_penal/size");
        }

        public function status(Size $size,$status,$id)
        {
           $id_related_row = $size->find($id);
          $id_related_row->status = $status; 
          $id_related_row->save();
           return redirect("/admin_penal/size");
        }


        public function delete(Size $size ,$id)
        {
           $size->find($id)->delete();
           session()->flash("message","Size deleted seccessfully");
           return redirect("/admin_penal/size");
        }

}
