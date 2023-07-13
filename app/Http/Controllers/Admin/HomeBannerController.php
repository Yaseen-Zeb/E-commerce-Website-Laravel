<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\Home_banner;
use Illuminate\Http\Request;
use Storage;
class HomeBannerController extends Controller
{
    public function manage_home_banner_show($id="")
    {
          if ($id != "" && $id > 0) {
           $arr[] = Home_banner::where(["id"=>$id])->get()[0];
           
           $data["url"] = "/admin_penal/home_banner/manage_home_banner/home_banner_update/".$id;
           $data["image"] = $arr[0]->image;
           $data["btn_val"] = "Update";
           
        }else{
            $data["url"] = "/admin_penal/home_banner/manage_home_banner/home_banner_insert";
           $data["image"] = "";
           $data["btn_val"] = "Add";
        }
        return view("admin.manage_home_banner",$data);
    }

    public function show()
    {
        $data["data"] = home_banner::all();
       return view("admin.home_banner",$data);
    }

    public function manage_home_banner_logic(Request $request,$id="")
    {
       
            if (isset($request->image)) {
                $image =  $request->file("image");
                $ext = $image->extension();
                if ($ext == "jpg" || $ext == "png" || $ext == "jpeg" || $ext == "webp") {
                    if ($id !== "") {
                       $find = Home_banner::where(["id"=>$id])->get()[0];
                       if ( Storage::exists("public/images/home_banner/".$find->image)) {
                        Storage::delete("public/images/home_banner/".$find->image);
                       }
                    }
                 $image_name = time()."_.".$ext;
                 $image->storeAs("public/images/home_banner/",$image_name);
                }else{
                    session()->flash("error","Plaese Select jpg, jpeg, or png formate image");
                    return redirect()->back();
                }
              }

             
        
        if ($id === "") {
            session()->flash("message","Home_banner added Successfully");
                $find = DB::table("home_banners")->insert(["image"=>$image_name,"status"=>1]);
        }else{
            session()->flash("message","Home_banner updated Successfully");
            if (isset($image_name)) {
               $find = DB::table("home_banners")->where(["id"=>$id])->update(["image"=>$image_name]);
            }else{
                return redirect("admin_penal/home_banner");
            }
        }
        return redirect("admin_penal/home_banner");
    }

        
public function status(home_banner $home_banner ,$status,$id)
{
    $find = DB::table("home_banners")->where(["id"=>$id])->update(["status"=>$status]);
  return redirect("admin_penal/home_banner");
}

    public function delete($id)
    {
        
       
         
            $find = DB::table("home_banners")->where(["id"=>$id])->delete();
        session()->flash("message","Home_banner Deleted Successfully");
        return redirect("admin_penal/home_banner");
        
        
    }
}
