if (document.querySelector(".mobile_login") !== null) {
    document.querySelector(".mobile_login").onclick = () =>{
    document.querySelector(".mobile-header-wrapper-style").classList.remove("sidebar-visible")
    document.querySelector(".body").classList.remove("mobile-menu-active")   
}
}


setInterval(() => {
    if (document.querySelector(".qty-val") != null) {
    let select_qty = document.querySelector(".qty-val")
    if (select_qty.textContent != 1 && select_qty.getAttribute("max") == "") {
        select_qty.textContent = 1
        document.querySelector(".cart_error").textContent = "First Select Size & Color"
        document.querySelector(".cart_error").style.display = "block";
        setTimeout(() => {
            document.querySelector(".cart_error").textContent = ""
        document.querySelector(".cart_error").style.display = "none";
        }, 3000);
    }
    if (select_qty.getAttribute("max") != "" && select_qty.textContent > select_qty.getAttribute("max")) {
        select_qty.textContent = select_qty.getAttribute("max")
        document.querySelector(".cart_error").textContent = "Only "+select_qty.getAttribute("max")+" quantity are  avalible";
        document.querySelector(".cart_error").style.display = "block";
        setTimeout(() => {
            document.querySelector(".cart_error").textContent = ""
        document.querySelector(".cart_error").style.display = "none";
        }, 3000);
    }
}
}, 500);


let pid_inpt = document.querySelector(".cart_pid");
let qty_inpt = document.querySelector(".cart_qty");
let sid_inpt = document.querySelector(".cart_sid");
let cid_inpt = document.querySelector(".cart_cid");
if (document.querySelector(".attr-size") == null) {
    document.querySelectorAll(".colors").forEach((e)=>{
        e.addEventListener("click",()=>{
            cid_inpt.value = e.getAttribute("cid");
        })
    })
    sid_inpt.value = 0;
}
if (document.querySelector(".attr-color") == null) {
    cid_inpt.value = 0;
}
let get = async (p_id,s_id,c_id,from) =>{
    if (from == 1) {
        cid_inpt.value = "";
        sid_inpt.value = s_id;
        
        if (document.querySelector(".attr-color") != null) {
    let res = await fetch("/get_colors/"+p_id+"/"+s_id);
    let data = await res.json();
    document.querySelector(".color-filter").innerHTML= data.result
        }else{
            cid_inpt.value = 0;
            get_attr_data(p_id,s_id,0);
        }
        
    }else{
        cid_inpt.value = c_id;
if (document.querySelector(".attr-size") != null) {
    get_attr_data(p_id,s_id,c_id);
}else{
    get_attr_data(p_id,0,c_id);
}
    } 
}

if (document.querySelector(".attr-size") == null) {
    document.querySelectorAll(".colors").forEach((e)=>{
    e.addEventListener("click",()=>{
   let pid = e.getAttribute("pid");
   let cid = e.getAttribute("cid");
   get_attr_data(pid,0,cid);
    })
})
}


let get_attr_data =async (pid,sid,cid)=>{
    let res = await fetch("/get_attr_data/"+pid+"/"+sid+"/"+cid);
    let data = await res.json();
document.querySelector(".main_img").src = document.querySelector(".hidden").value+"/"+data.result[0].image;
document.querySelector(".price").textContent = "Rs."+data.result[0].price;
document.querySelector(".mrp").textContent = "Rs."+data.result[0].mrp;
document.querySelector(".sku").textContent = data.result[0].sku;
document.querySelector(".stock_div").style.display = "block";
document.querySelector(".stock_qty_span").textContent = data.avalible_qty;
document.querySelector(".qty-val").setAttribute("max",data.avalible_qty)
document.querySelector(".qty-val").textContent = 1
}
let home_add_to_cart = (pid,sid,cid,qty)=>{
pid_inpt.value = pid;
sid_inpt.value = sid;
cid_inpt.value = cid;
qty_inpt.value = qty;
add_to_cart();
}


let update_cart = (pid,cid,sid,from,i)=>{
    let qty = document.querySelector(".qty"+i);
    
        if (from == "up") {
            qty.value++;
            qty_inpt.value = qty.value;
        } else {
        if (qty.value <= 1) {
            qty.value = 1
        } else {
            qty.value = qty.value-1

        }
        qty_inpt.value = qty.value;
    }
    let sub_total = document.querySelector(".sub_total"+i);
    let price = document.querySelector(".price"+i);
    sub_total.textContent = price.textContent*qty_inpt.value;
    pid_inpt.value = pid;
    sid_inpt.value = sid;
    cid_inpt.value = cid;
   let SBT =  document.querySelectorAll(".SBT");
   let total = 0;
   for (let i = 0; i < SBT.length; i++) {
    total = total + parseInt(SBT[i].textContent);
   }
//    document.querySelector(".cart_total").textContent = total;
    add_to_cart("",i)
    }

    let remove = (pid,cid,sid,i) =>{
        pid_inpt.value = pid;
    sid_inpt.value = sid;
    cid_inpt.value = cid;
    qty_inpt.value = "remove";
    
    document.querySelectorAll(".row"+i).forEach((e)=>{
        e.remove()
        if (i == 0 && document.querySelector(".chk_btn") != null) {
        document.querySelector(".chk_btn").remove()
        }
    })
    add_to_cart();
    }

let cart_error = document.querySelector(".cart_error");
let add_to_cart = async (pid="",check_while_update_qty_in_cart_page) =>{
    if (pid_inpt.value == "" ) {
        pid_inpt.value = pid;
    }
    if (document.querySelector(".qty-val") != null) {
        qty_inpt.value = document.querySelector(".qty-val").textContent
    }
    if (sid_inpt.value === "") {
        cart_error.textContent = "Please select size !"
        cart_error.style.display = "block"
        setTimeout(() => {
            cart_error.style.display = "none"
        }, 5000);
    }else if (cid_inpt.value === "") {
        cart_error.textContent = "Please select color !"
        cart_error.style.display = "block"
        setTimeout(() => {
            cart_error.style.display = "none"
        }, 5000);
    }else{

        let ajax = {
            method : "post",
            body : new FormData(document.querySelector("#cart_form"))
        }
        let res = await fetch("/add_to_cart",ajax) 
        let data = await res.json()
        
        let str = "";
        let total = 0;
        let i = 0;
console.log(data.result);
        if (data.data != null) {
            // alert("f")
            alert(data.result)
            
        document.querySelector(".cart_count").textContent = data.data.length
        if (data.data.length > 0) {
            let img_path = document.querySelector(".img_path").value;
            str +=`<div class="cart-dropdown-wrap cart-dropdown-hm2">
                   <ul class="cart_pop">`;
        data.data.forEach(e => {
            total += e.qty*e.price
         str +=   `<li class="row${i}">
                <div class="shopping-cart-img">
                    <a href="/product_details/${e.slug}"><img alt="Surfside Media" src="${img_path+e.image}"></a>
                </div>
                <div class="shopping-cart-title">
                    <h4><a href="/product_details/${e.slug}">${e.title}</a></h4>
                    <h4><span>${e.qty} × </span><span>Rs.</span><span>${e.price}</span></h4>
                </div>
                <div class="shopping-cart-delete">
                    <a href="#"><i onclick="remove(${e.p_id},${e.color_id},${e.size_id},${i})"  class="fi-rs-cross-small"></i></a>
                </div>
            </li>`;
            i++;
        });
        str += ` </ul>
        <div class="shopping-cart-footer">
            <div class="shopping-cart-total">
                <h4>Total <span class="total">Rs.${total}</span></h4>
            </div>
            <div class="shopping-cart-button">
                <a href="/cart.php" class="outline">View cart</a>
                <a href="checkout.php">Checkout</a>
            </div>
        </div>
    </div>`
    jQuery(".pop").html(str)
            }else{
                document.querySelector(".cart-dropdown-wrap").remove();
            
        }
        }else if(data.qty != null && document.querySelector(".qty"+check_while_update_qty_in_cart_page) != null){
            document.querySelector(".qty"+check_while_update_qty_in_cart_page).value = data.qty
            alert(data.result)
            window.location.href = window.location.href
        }else{
            
            alert(data.result)   
        }
    
    }
        }
         

        // --->>>
    let limit = (i) => {
       document.querySelector(".limit").value = document.querySelector(".limit"+i).textContent
       jQuery("#sort_form").submit();
    }    

    let sort = (from) =>{
        document.querySelector(".sort").value = from
        jQuery("#sort_form").submit();
    }

let color_filter = (i) =>{
let color_filter_inp = document.querySelector(".color_filter");
if (document.querySelector(".ch"+i).checked == true) {
    color_filter_inp.value = color_filter_inp.value+i+",";
}else{
    color_filter_inp.value = color_filter_inp.value.replace(i+",","")
}
    }
    let filter = () =>{
        document.querySelector(".min").value = document.querySelector("#min").value
        document.querySelector(".max").value = document.querySelector("#max").value
        jQuery("#sort_form").submit();
    }
    

    let search = (from) =>{
if (from == "mob" && document.querySelector(".search_inp_mob").value != '') {
    window.location.href = "/search/"+document.querySelector(".search_mob").value;
} else if(from == "lg" && document.querySelector(".search_inp").value != ''){
    window.location.href = "/search/"+document.querySelector(".search_inp").value;
}
    }

    // register
    if (document.querySelector(".frmregister") != null) {
        document.querySelector(".frmregister").onsubmit = async (e) => {
            e.preventDefault();
            let submit_btn =  document.querySelector(".submit_btn");
            submit_btn.textContent = "Please wait..."
            let error =  document.querySelector(".error");
            let success =  document.querySelector(".success");
            
          
                let ajax = {
                    method : "post",
                    body : new FormData(document.querySelector(".frmregister"))
                }
                let res = await fetch("/register",ajax)
                let data = await res.json()
                if (data.result == "success") {
                    submit_btn.textContent = "Submit & Register"
                    success.textContent = "Registered Successfully";
                    success.style.display = "block";
                    setTimeout(() => {
                     success.textContent = "";
                    success.style.display = "none";
                    window.location.href = "/thank_you"
                    }, 3000);
                } else {
                    submit_btn.textContent = "Submit & Register"
                    error.textContent = data.result;
                    error.style.display = "block";
                    setTimeout(() => {
                     error.textContent = "";
                    error.style.display = "none";
                    }, 8000);
            }
            
        }
    }

    // login
    if (document.querySelector(".loginform") != null) {
         document.querySelector(".loginform").onsubmit = async (e) => {
            e.preventDefault();
            let login_submit_btn =  document.querySelector(".login_submit_btn");
            login_submit_btn.textContent = "Please wait..."
            let login_error =  document.querySelector(".login_error");
            let login_success =  document.querySelector(".login_success");
            
                let ajax = {
                    method : "post",
                    body : new FormData(document.querySelector(".loginform"))
                }
                let res = await fetch("/login",ajax)
                let data = await res.json()
                if (data.result == "success") {
                    login_submit_btn.textContent = "Login"
                    login_success.textContent = "Loged Successfully";
                    login_success.style.display = "block";
                    setTimeout(() => {
                        // jQuery(".close").click();
window.location.href =  window.location.origin+window.location.pathname
                     login_success.textContent = "";
                    login_success.style.display = "none";
                    
                    }, 3000);
                } else {
                    login_submit_btn.textContent = "Login"
                    login_error.textContent = data.result;
                    login_error.style.display = "block";
                    setTimeout(() => {
                     login_error.textContent = "";
                    login_error.style.display = "none";
                    }, 8000);
                }
            }
            
        }

        // profile
    if (document.querySelector(".frmprofileupdate") != null) {
        document.querySelector(".frmprofileupdate").onsubmit = async (e) => {
            e.preventDefault();
            let submit_btn =  document.querySelector(".submit_btn");
            submit_btn.textContent = "Please wait..."
            let mob_inp =  document.querySelector(".mobile");
            let error =  document.querySelector(".error");
            let success =  document.querySelector(".success");
            
            if (mob_inp.value.length > 11 || mob_inp.value.length < 11) {
                if (mob_inp.value.length != 0) {
                submit_btn.textContent = "Submit"
               error.textContent = "Mobile unmber should be at 11 digits";
               error.style.display = "block";
               setTimeout(() => {
                error.textContent = "";
               error.style.display = "none";
               }, 8000);
            }
            }

            if(mob_inp.value.length == 11 || mob_inp.value.length == 0){
                let ajax = {
                    method : "post",
                    body : new FormData(document.querySelector(".frmprofileupdate"))
                }
                let res = await fetch("/update_profile",ajax)
                let data = await res.json()
                
                if (data.result == "success") {
                    submit_btn.textContent = "Submit"
                    success.textContent = "Profile Updated Successfully";
                    success.style.display = "block";
                    setTimeout(() => {
                     success.textContent = "";
                    success.style.display = "none";
                    window.location.href = "/profile"
                    }, 3000);
                } else {
                    submit_btn.textContent = "Submit"
                    error.textContent = data.result;
                    error.style.display = "block";
                    setTimeout(() => {
                     error.textContent = "";
                    error.style.display = "none";
                    }, 8000);
                }
            }
            
        }
    }

    if (document.querySelector(".password") != null) {
        document.querySelectorAll(".password").forEach((e)=>{
            e.onmouseover = () =>{
                e.type = "text";
            }
            e.onmouseleave = () =>{
                e.type = "password";
            }
        })
    }

    // coupon 
    if (document.querySelector(".coupon_form") != null) {
        document.querySelector(".coupon_form").onsubmit = async (e) => {
                e.preventDefault();
                let coupon_submit_btn =  document.querySelector(".coupon_submit_btn");
                coupon_submit_btn.textContent = "Please wait..."
                let coupon_error =  document.querySelector(".coupon_error");
                let coupon_success =  document.querySelector(".coupon_success");
                
                    let ajax = {
                        method : "post",
                        body : new FormData(document.querySelector(".coupon_form"))
                    }
                    let res = await fetch("/coupon",ajax)
                    let data = await res.json()
                    if (data.result == "success") {
                        document.querySelector(".sub_total").textContent ="Rs "+data.total;
                        coupon_submit_btn.textContent = "Apply Coupon"
                        coupon_success.textContent = "Coupon Applyed Successfully";
                        coupon_success.style.display = "block";
                        document.querySelector(".coupon_inp").value = data.coupon_code;
                        document.querySelector(".total_inp").value = data.total;
                        setTimeout(() => {
                            document.querySelector(".coupon_col").innerHTML=
                            `
                        <div class="toggle_info" style="display: flex; justify-content:space-between">
                        <span><i class="fi-rs-label mr-10"></i><span class="text-muted">Coupon has been applaid successfully </span>
                        <strike>${document.querySelector(".total").textContent}</strike>
                        <span class="text-danger"> ${"Rs "+data.total}</span>
                        </span>
                         <button class="btn btn-danger py-0 px-2" onclick="remove_coupon()">Remove</button>
                        </div>
                            `
                         coupon_success.textContent = "";
                        coupon_success.style.display = "none";
                        }, 2000);
                    } else {
                        coupon_submit_btn.textContent = "Apply Coupon"
                       coupon_error.textContent = data.result;
                       coupon_error.style.display = "block";
                        setTimeout(() => {
                        coupon_error.textContent = "";
                       coupon_error.style.display = "none";
                        }, 8000);
                    }
                }
        }

        function remove_coupon() {
            window.location.href = window.location.href
        }

        // checkout
        if (document.querySelector(".checkout_form") != null) {
            document.querySelector(".checkout_form").onsubmit = async (e) => {
                e.preventDefault();
                let submit_btn =  document.querySelector(".checkout_btn");
                submit_btn.textContent = "Please wait..."
                let error =  document.querySelector(".checkout_error");
                let success =  document.querySelector(".checkout_success");
                
               
            let check_coupon_inp = "";
            if (document.querySelector(".coupon_offical_inp") == null) {
                check_coupon_inp = "";
            }else{
            check_coupon_inp = document.querySelector(".coupon_offical_inp").value
            }
                if(check_coupon_inp == ""){
                    let ajax = {
                        method : "post",
                        body : new FormData(document.querySelector(".checkout_form"))
                    }
                    let res = await fetch("/checkout",ajax)
                    let data = await res.json()
                    
                    
                    if (data.result == "success") {
                       window.location.href = "/varifaction";
                    }else{
                        error.textContent = data.result;
                        error.style.display = "block";
                        setTimeout(() => {
                         error.textContent = "";
                        error.style.display = "none";
                        }, 5000);
                    }
                }else{
                    submit_btn.textContent = "Submit"
                    error.textContent = "Coupon input is filled but not applied";
                        error.style.display = "block";
                        setTimeout(() => {
                         error.textContent = "";
                        error.style.display = "none";
                        }, 8000);
                    // document.querySelector(".coupon_error").textContent = "Coupon input is filled but not applied";
                    //     document.querySelector(".coupon_error").style.display = "block";
                        // if (document.querySelector(".coupon_offical_inp") != null) {
                            // jQuery(".coupon_offical_inp").focus();
                        // }
                        // setTimeout(() => {
                        //     document.querySelector(".coupon_error").textContent = "";
                        //  document.querySelector(".coupon_error").style.display = "none";
                        // }, 8000);
                }
                
            }
        }

        if (document.querySelector(".email_otp") != null) {
            document.querySelector(".email_otp").onsubmit = async (e) => {
               e.preventDefault();
                   let ajax = {
                       method : "post",
                       body : new FormData(document.querySelector(".email_otp"))
                   }
                   let res = await fetch("/email_otp",ajax)
                   let data = await res.json()
                   if (data.result == "success") {
                     document.querySelector(".mail_otp").innerHTML = 
                     `<div class="card-header">
                     <h4 class="my-0 text-center">Enter OTP Code</h4>
                    </div>
                    <div class="card-body text-center  pt-4">

                    <form class="email_varify_form" >
                    <div class="alert alert-primary py-0 text-center  email_varify_success" style="display:none" role="alert"></div>
                    <div class="alert alert-danger py-0 text-center  email_varify_error" style="display:none" role="alert"></div>
                    <input class="mail_token" type="hidden" name="_token" value="">
                      <div class="alert alert-warning py-0 otp text-center w-50 mx-auto" role="alert">${data.otp}</div>
                     <div class="form-group d-flex w-100">
                       <input maxlength="1" required type="text" class="form-control text-center w-25" style="font-size: 30px; font-weight: 600;"  name="first">
                       <input maxlength="1" required type="text" class="form-control text-center w-25" style="font-size: 30px; font-weight: 600;"  name="second">
                       <input maxlength="1" required type="text" class="form-control text-center w-25" style="font-size: 30px; font-weight: 600;"  name="third">
                       <input maxlength="1" required type="text" class="form-control text-center w-25" style="font-size: 30px; font-weight: 600;"  name="forth">
                     </div>
                     <button type="submit"  style="font-size: 20; padding: 7px 23px" class="btn btn-danger email_varify_btn m-auto">Varify</button>
                    </form>`;
                    document.querySelector(".mail_token").value=document.querySelector(".form_token input").value
                   } 
               }
               
           }
           setInterval(() => {
             if (document.querySelector(".email_varify_form") != null) {
            document.querySelector(".email_varify_form").onsubmit = async (e) => {
               e.preventDefault();
               let submit_btn =  document.querySelector(".email_varify_btn");
                submit_btn.textContent = "Please wait..."
                let error =  document.querySelector(".email_varify_error");
                let success =  document.querySelector(".email_varify_success");
                   let ajax = {
                       method : "post",
                       body : new FormData(document.querySelector(".email_varify_form"))
                   }
                   let res = await fetch("/email_varify",ajax)
                   let data = await res.json()
                   if (data.result == "success") {
                    submit_btn.textContent = "Varify"
                    success.textContent = "Email Varified Successfully";
                    success.style.display = "block";
                    setTimeout(() => {
                     success.textContent = "";
                    success.style.display = "none";
                    window.location.href = window.location.href
                    }, 3000);
                   }else{
                     submit_btn.textContent = "Varify"
                    error.textContent = data.result
                        error.style.display = "block";
                        setTimeout(() => {
                         error.textContent = "";
                        error.style.display = "none";
                        }, 5000);
                   }
               }}
           }, 2000);


           if (document.querySelector(".mobile_otp") != null) {
            document.querySelector(".mobile_otp").onsubmit = async (e) => {
               e.preventDefault();
                   let ajax = {
                       method : "post",
                       body : new FormData(document.querySelector(".mobile_otp"))
                   }
                   let res = await fetch("/mobile_otp",ajax)
                   let data = await res.json()
                   if (data.result == "success") {
                  document.querySelector(".fs").remove();  
                    document.querySelector(".s").style.display="block"; 
                    document.querySelector(".otpp").textContent = data.otp;
                   } 
               }
               
           }

           setInterval(() => {
            if (document.querySelector(".mobile_varify_form") != null) {
           document.querySelector(".mobile_varify_form").onsubmit = async (e) => {
              e.preventDefault();
              let submit_btn =  document.querySelector(".mobile_varify_btn");
               submit_btn.textContent = "Please wait..."
               let error =  document.querySelector(".mobile_varify_error");
               let success =  document.querySelector(".mobile_varify_success");
                  let ajax = {
                      method : "post",
                      body : new FormData(document.querySelector(".mobile_varify_form"))
                  }
                  let res = await fetch("/mobile_varify",ajax)
                  let data = await res.json()
                  console.log(data);
                  if (data.result == "success") {
                   submit_btn.textContent = "Varify"
                   success.textContent = "Order has been placed successfully";
                   success.style.display = "block";
                   setTimeout(() => {
                    success.textContent = "";
                   success.style.display = "none";
                   window.location.href = "/order_placed"
                   }, 3000);
                  }else{
                    submit_btn.textContent = "Varify"
                   error.textContent = data.result
                       error.style.display = "block";
                       setTimeout(() => {
                        error.textContent = "";
                       error.style.display = "none";
                       }, 5000);
                  }
              }}
          }, 2000);

          if (document.querySelector(".review_form") != null) {
            document.querySelector(".review_form").onsubmit = async (e) => {
               e.preventDefault();
               let submit_btn =  document.querySelector(".r_btn");
               submit_btn.textContent = "Please wait..."
               let error =  document.querySelector(".r_e");
               let success =  document.querySelector(".r_s");
                   let ajax = {
                       method : "post",
                       body : new FormData(document.querySelector(".review_form"))
                   }
                   let res = await fetch("/add_review",ajax)
                   let data = await res.json()
                   if (data.result == "success") {
                    submit_btn.textContent = "Submit Review"
                    success.textContent = "Review Added Successfully";
                    success.style.display = "block";
                    setTimeout(() => {
                     success.textContent = "";
                    success.style.display = "none";
                    window.location.href = window.location.href
                    }, 3000);
                   }else{
                     submit_btn.textContent = "Submit Review"
                    error.textContent = data.result
                        error.style.display = "block";
                        setTimeout(() => {
                         error.textContent = "";
                        error.style.display = "none";
                        }, 5000);
                   }
               }
               
            }

            let add_wish_list = async (p_id,action) =>{
                let res = await fetch("/add_to_wishlist/"+p_id+"/"+action)
                let data = await res.json();
                if (data.result == "success") {
                    alert("Addded")
                    document.querySelectorAll(".wishlist_count").forEach((e)=>{
                        e.textContent = data.total_count
                    })
                } else if(data.result == "Deleted"){
                    alert(data.result)
                        window.location.href = window.location.origin+"/wishlist"
                    
                }else{
                    alert(data.result)
                }
            }
           
       



        




    
    

