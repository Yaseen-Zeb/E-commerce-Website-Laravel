<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (session()->has("admin_login")) {
            
            return redirect("admin_penal/dashboard");
        }else{
            return view("admin.index");
        }
        
    }

  
    public function admin_login(Request $request){
     $email = $request->post('username');
     $password = $request->post('password');
    //  return $password;
    $admin_table = new Admin;
    $adminTableRows =  $admin_table->all();
    if (filter_var($email,FILTER_VALIDATE_EMAIL)) {
    foreach ($adminTableRows as $value) {
    if ($value["email"] != $email) {
    $request->session()->flash("error","Email Is Not Correct");
    return redirect("admin_penal");
    }else if($value["password"] != $password){
    $request->session()->flash("error","Password Is Not Correct");
    return redirect("admin_penal");
    }else{
    $request->session()->put("admin_login","yes");
    $request->session()->put("admin_id",$value["id"]);
    session(["admin_name"=>$value["name"]]);
    return view("admin.dashboard");
} 
}
}else{
    $request->session()->flash("error","Please Enter Valid Email");
    return redirect("admin_penal");}}


    public function admin_logout()
    {
       session()->flush();
       return redirect("admin_penal");
    }
    }

