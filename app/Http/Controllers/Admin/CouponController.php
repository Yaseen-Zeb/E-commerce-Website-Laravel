<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    
    public function show()
    {
       $data["data"] = Coupon::all();
       return view("admin.coupon",$data);
    }

   
    public function manage_coupon_show(Coupon $coupon,$id = "")
    {
        if ($id != "" && $id > 0) {
        $arr[] = $coupon->find($id);
        $data["url"] = "/admin_penal/coupon/manage_coupon/update/".$id;
        $data["title"] = $arr[0]->title;
        $data["code"] = $arr[0]->code;
        $data["value"] = $arr[0]->value;
        $data["type"] = $arr[0]->type;
        $data["order_min_amount"] = $arr[0]->order_min_amount;
        $data["use_times"] = $arr[0]->use_times;
        $data["btn_val"] = "Update";
        } else {
            $data["url"] = "/admin_penal/coupon/manage_coupon/insert";
          $data["title"] = "";
          $data["code"] = "";
          $data["value"] = "";
          $data["type"] = "";
          $data["order_min_amount"] = "";
          $data["use_times"] = "";
          $data["btn_val"] = "Add";
        }
        return view("admin.manage_coupon",$data);
    }

    public function manage_coupon_logic(Request $request,Coupon $coupon,$id="")
    {
        if (isset($coupon->where(["code"=>$request->code])->get()[0])) {
           $id_in_case_of_coupon_code = $coupon->where(["code"=>$request->code])->get()[0]->id;
        }else{
            $id_in_case_of_coupon_code = 0;
        }

            foreach ($coupon->all() as $value) {
              if ($value->code == $request->code) {
                if ($id != $id_in_case_of_coupon_code) {
                session()->flash("error","Category_Code is already been taken");
                return redirect()->back();
            }
              }
            }

            if ($id !== "") {
                $find = $coupon->find($id);
        $find->title = $request->title;
       $find->code = $request->code;
       $find->value = $request->value;
        $find->type=$request->type;
        $find->order_min_amount=$request->order_min_amount;
        $find->use_times=$request->use_times;
       $find->save();
        session()->flash("message","Coupon Updated seccessfully");
             }else{
       $coupon->title = $request->title;
       $coupon->code = $request->code;
       $coupon->value = $request->value;
       $coupon->type=$request->type;
       $coupon->order_min_amount=$request->order_min_amount;
       $coupon->use_times=$request->use_times;
       $coupon->status = 1;
       $coupon->save();
       session()->flash("message","Coupon added seccessfully");
             } 
             return redirect("/admin_penal/coupon");
        }

        public function status(Coupon $coupon,$status,$id)
        {
           $id_related_row = $coupon->find($id);
          $id_related_row->status = $status; 
          $id_related_row->save();
           return redirect("/admin_penal/coupon");
        }


        public function delete(Coupon $coupon ,$id)
        {
           $coupon->find($id)->delete();
           session()->flash("message","Coupon deleted seccessfully");
           return redirect("/admin_penal/coupon");
        }

       
    }

