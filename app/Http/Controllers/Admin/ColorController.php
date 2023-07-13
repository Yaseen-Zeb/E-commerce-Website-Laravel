<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function show()
    {
       $data["data"] = Color::all();
       return view("admin.color",$data);
    }

   
    public function manage_color_show(Color $color,$id = "")
    {
        if ($id != "" && $id > 0) {
        $arr[] = $color->find($id);
        $data["url"] = "/admin_penal/color/manage_color/update/".$id;
        $data["color_name"] = $arr[0]->color_name;
        $data["btn_val"] = "Update";
        } else {
            $data["url"] = "/admin_penal/color/manage_color/insert";
          $data["color_name"] = "";
          $data["btn_val"] = "Add";
        }
        return view("admin.manage_color",$data);
    }

    public function manage_color_logic(Request $request,Color $color,$id="")
    {
        if (isset($color->where(["color_name"=>$request->color_name])->get()[0])) {
           $id_in_case_of__colorName = $color->where(["color_name"=>$request->color_name])->get()[0]->id;
        }else{
            $id_in_case_of__colorName = 0;
        }

            foreach ($color->all() as $value) {
              if ($value->color_name == $request->color_name) {
                if ($id != $id_in_case_of__colorName) {
                session()->flash("error","Color_name is already been taken");
                return redirect()->back();
            }
              }
            }

            if ($id !== "") {
                $find = $color->find($id);
        $find->color_name = $request->color_name;
       $find->save();
        session()->flash("message","Color Updated seccessfully");
             }else{
       $color->color_name = $request->color_name;
       $color->status = 1;
       $color->save();
       session()->flash("message","Color added seccessfully");
             } 
             return redirect("/admin_penal/color");
        }

        public function status(Color $color,$status,$id)
        {
           $id_related_row = $color->find($id);
          $id_related_row->status = $status; 
          $id_related_row->save();
           return redirect("/admin_penal/color");
        }


        public function delete(Color $color ,$id)
        {
           $color->find($id)->delete();
           session()->flash("message","Color deleted seccessfully");
           return redirect("/admin_penal/color");
        }

}
