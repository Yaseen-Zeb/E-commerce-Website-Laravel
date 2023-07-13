

let getRelatedData = async () => {
    let cat_id = document.querySelector(".cat_selector").value;

    let res = await fetch(`http://127.0.0.1:8000/admin_penal/product/manage_product/get_options/${cat_id}`);
    let data = await res.json();
    let brand_options = "<option value=''>Select Brand</option>";
    let sub_cat_options = "<option value=''>Select Sub Category</option>";

    if (data.result.brand.length == 0) {
        document.querySelector(".brand_selector").innerHTML = "<option value=''>No Brand Form Selected Category</option>";
    } else {
        data.result.brand.forEach(e => {
            brand_options += `
   <option value="${e.id}">${e.brand_name}</option>`
        });
        document.querySelector(".brand_selector").innerHTML = brand_options;
    }

    if (data.result.sub.length == 0) {
        document.querySelector(".sub_cat_selector").innerHTML = "<option value=''>No Sub Category Form Selected Category</option>";
    } else {
        data.result.sub.forEach(e => {
            sub_cat_options += `
         <option value="${e.id}">${e.sub_cat_name}</option>`
        });
        document.querySelector(".sub_cat_selector").innerHTML = sub_cat_options;
    }
}

let update_order_status = (order_id) => {
   let c = confirm("Are you sure?")
    if (c == true) {
      window.location.href = "/admin_penal/update_order_status/"+document.querySelector(".update_order_status").value+"/"+order_id
    }

}
