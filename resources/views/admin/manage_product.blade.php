@extends('admin.main')
@if ($title != "")
    @section('page_title',"Product upadte Page")
    @else
    @section('page_title',"Product add Page")
    @endif
@section('main_section')
@section('product_active',"active")

<div class="message"></div>

<div class="content-wrapper h-auto">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Add New Product</h1>
            </div>
            <div class="col-sm-6" style="text-align: end">
            <a href="{{url("admin_penal/product")}}" class="btn btn-primary btn-sm mr-3">BACK</a>
            </div>
          </div>
      </div><!-- /.container-fluid -->
    </section>
   {{-- {{$sub_cat_id}} --}}
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-11">@if (session()->has("error") )
                    <div class="alert alert-danger py-0">{{session("error")}}</div>
              @endif
                            <form class="form-horizontal" id="add-city" action="{{$url}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                <div class="form-group col-7">
                                    <label for="">Product Title *</label>
                                    <input required type="text" class="form-control" value="{{$title}}" name="title"  placeholder="Product Title" >
                                </div>
                                <div class="form-group col-5">
                                    <label for="">Product Slug *</label>
                                    <input required type="text" class="form-control" value="{{$slug}}" name="slug"  placeholder="Product Slug" >
                                </div>

                                <div class="form-group col-4">
                                    <label for="">Product Category *</label>
                                  <select onchange="getRelatedData()" class="form-control cat_selector" name="category" id="" required>
                                    <option value="">Select Category</option>
                                    @foreach ($cat_s as $item)
                                    @if ($cat_id == $item["cat_id"])
                                    <option selected value="{{$item["cat_id"]}}">{{$item["category_name"]}}</option>
                                    @else
                                          <option value="{{$item["cat_id"]}}">{{$item["category_name"]}}</option>
                                    @endif
                                    @endforeach
                                  </select>
                                </div>
                                <div class="form-group col-4">
                                    <label for="">Product Sub Category *</label>
                                  <select  class="form-control sub_cat_selector" name="sub_cat_id" id="" required>
                                    <?php
                                    if (isset($add)) {
                                     echo '<option value="">First Select Category</option>';
                                    } else {
                                      ?>
                                      <option value="">Select Sub Category</option>
                                    @foreach ($sub_cat as $item)
                                    @if ($sub_cat_id == $item->id)
                                    <option selected value="{{$item->id}}">{{$item->sub_cat_name}}</option>
                                    @else
                                          <option value="{{$item->id}}">{{$item->sub_cat_name}}</option>
                                    @endif
                                    @endforeach
                                    <?php
                                    }
                                    ?>
                                  </select>
                                </div>
                                <div class="form-group col-4">
                                    <label for="">Product Brand *</label>
                                  <select class="form-control brand_selector" name="brand_id" id="" >
                                    <?php
                                    if (isset($add)) {
                                     echo '<option value="0">First Select Category</option>';
                                    } else {
                                      ?>
                                    <option value="">Select Brand</option>
                                    @foreach ($brand as $item)
                                    @if ($brand_id == $item->id)
                                    <option selected value="{{$item->id}}">{{$item->brand_name}}</option>
                                    @else
                                          <option value="{{$item->id}}">{{$item->brand_name}}</option>
                                    @endif
                                    @endforeach
                                    <?php
                                    }?>
                                  </select>
                                </div>
                               
                               

                                <div class="form-group col-4">
                                    <label for="">Lead time</label>
                                    <input  type="text" class="form-control" value="{{$lead_time}}" name="lead_time"  placeholder="Lead time" >
                                </div>
                                <div class="form-group col-4">
                                    <label for="">Tax</label>
                                    <input  type="text" class="form-control" value="{{$tax}}" name="tax"  placeholder="Tax" >
                                </div>
                                <div class="form-group col-4">
                                    <label for="">Tax type</label>
                                    <input  type="text" class="form-control" value="{{$tax_type}}" name="tax_type"  placeholder="Tax type" >
                                </div>

                                <div class="form-group col-3">
                                    <label for="">Is Promo *</label>
                                  <select class="form-control" name="is_promo" id="" required>
                                    @if ($is_promo == 1)
                                    <option selected value="1">yes</option>
                                    <option value="0">no</option>
                                    @elseif($is_promo == 0)
                                    <option value="1">yes</option>
                                    <option selected value="0">no</option>
                                    @else
                                    <option  value="">Is Promotional ?</option>
                                    <option value="1">yes</option>
                                    <option  value="0">no</option>
                                    @endif
                                  </select>
                                </div>
                                <div class="form-group col-3">
                                    <label for="">Is Featured *</label>
                                  <select class="form-control" name="is_featured" id="" required>
                                        @if ($is_featured == 1)
                                        <option selected value="1">yes</option>
                                        <option value="0">no</option>
                                        @elseif($is_featured == 0)
                                        <option value="1">yes</option>
                                        <option selected value="0">no</option>
                                        @else
                                        <option value="">Is Featured ?</option>
                                        <option value="1">yes</option>
                                        <option  value="0">no</option>
                                        @endif
                                  </select>
                                </div>
                                <div class="form-group col-3">
                                    <label for="">Is Trending *</label>
                                  <select class="form-control" name="is_trending" id="" required>
                                    @if ($is_trending == 1)
                                    <option selected value="1">yes</option>
                                    <option value="0">no</option>
                                    @elseif($is_trending == 0)
                                    <option value="1">yes</option>
                                    <option selected value="0">no</option>
                                    @else
                                    <option  value="">Is Trending ?</option>
                                    <option value="1">yes</option>
                                    <option  value="0">no</option>
                                    @endif
                                  </select>
                                </div>
                                <div class="form-group col-3">
                                    <label for="">Is Discounted *</label>
                                  <select class="form-control" name="is_discounted" id="" required>
                                    @if ($is_discounted == "1")
                                    <option selected value="1">yes</option>
                                    <option value="0">no</option>
                                    @elseif($is_discounted == "0")
                                    <option value="1">yes</option>
                                    <option selected value="0">no</option>
                                    @else
                                    <option  value="">Is Discounted ?</option>
                                    <option value="1">yes</option>
                                    <option  value="0">no</option>
                                    @endif
                                  </select>
                                </div>

                                




                                <div class="form-group col-8">
                                    <label for="">Product Uses</label>
                                    <textarea class="form-control" name="uses" placeholder="Product Uses" id="" rows="2">{{$uses}}</textarea>
                                </div>
                                <div class="form-group col-4">
                                    <label for="">Product Keywords *</label>
                                    <textarea class="form-control" name="keywords" placeholder="Product Keywords" id="" rows="2">{{$keywords}}</textarea>
                                </div>
                                <div class="form-group col-12">
                                    <label for="">Product Description *</label>
                                    <textarea class="form-control description" name="description" placeholder="Product Description" id="" rows="2">{{$description}}</textarea>
                                </div>
                            </div>
                            {{--  --}}
                            
                            <div class="row image_row">
                                <h4 class="mb-0 w-100 mb-3">Select product Images</h4>
                                    <div class="form-group col-2">
                                        <label for="" class="mb-0">Product main image *</label>
                                        <input @if ($title == "")
                                            required    
                                        @endif  type="file" class="form-control-file" name="image">
                                        @if ($image != "")
                                             <div><a target="_blank" href="{{asset('storage/images/'.$image)}}"><img  width="95" height="70" src="{{asset('storage/images/'.$image)}}" alt="df"></a> </div>
                                        @endif
                                       
                                        <button type="button" onclick="add_img()" class="btn btn-success btn-sm mt-1"><span style="">Add</span> &nbsp; <i class="fa fa-plus" aria-hidden="true"></i></button>
                                    </div>

                                    <?php
                            if (isset($multi_imgs[0])) {
                               foreach ($multi_imgs as $value) {
                                ?>
                                <div class="form-group col-2 ">
                                    <label for="" class="mb-0">Product other image</label>
                                    <input hidden type="text" name="forimages[]" value="1" id="">
                                    <input hidden type="text" name="for_update[]" value="{{$value->img_id}}" id="">
                                                <input @if ($title == "")
                                                required    
                                                @endif  type="file" class="form-control-file" name="images[]">
                                                <div><a target="_blank" href="{{asset('storage/images/'.$value->image)}}"><img  width="95" height="70" src="{{asset('storage/images/'.$value->image)}}" alt="df"></a></div>
                                                
                                                <a href="{{url('/admin_penal/product/manage_product/delete_multi_image/'.$value->img_id)}}" type="button"  class="btn btn-danger btn-sm mt-1"><span style="">Remove</span> &nbsp; <i class="fa fa-minus" aria-hidden="true"></i></a>
                                                </div>
                                <?php
                               }
                            }
                            ?>
                            </div>

                            
                            {{--  --}}
                       <?php 
                       if (isset($attr[0])) {
                        $v = 1;
                        if ($v == 1) {
                          $append = "product_attr_row";
                        }else{
                          $append = "";
                        }
                        ?>
                        
                        <div class="row {{$append}}">
                                <h3 class="mb-0 mt-3">Product Attributes</h3>
                                <?php
                       foreach ($attr as  $value) {
                        ?>
                        <hr  style="border:0.1px solid grey; width:100%; margin-top:0px">
                                <div class="form-group col-3">
                                    <label for="">SKU</label>
                                    <input type="hidden" name="update_condition[]" value="{{$value['attr_id']}}" id="">
                                    <input required type="text" class="form-control" value="{{$value['sku']}}" name="sku[]"  placeholder="Product SKU" >
                                </div>
                                <div class="form-group col-3">
                                    <label for="">Select Size</label>
                                  <select class="form-control S" id="" name="size[]" id="">
                                    <option value="">Select Size</option>
                                    @foreach ($size_options as $item)
                                    @if ($item->id == $value['size_id'])
                                    @php
                                        $selected = "selected";
                                    @endphp
                                    @else
                                    @php
                                        $selected = "";
                                    @endphp
                                    @endif
                                    <option {{$selected}} value="{{$item->id}}">{{$item->size_name}}</option>
                                    @endforeach
                                  </select>
                                </div>
                                <div class="form-group col-3">
                                    <label for="">Select Color</label>
                                  <select class="form-control C" name="color[]" id="">
                                    <option value="">Select Color</option>
                                    @foreach ($color_options as $item)
                                    @if ($item->id == $value['color_id'])
                                    @php
                                        $selected = "selected";
                                    @endphp
                                    @else
                                    @php
                                        $selected = "";
                                    @endphp
                                    @endif
                                    <option {{$selected}} value="{{$item->id}}">{{$item->color_name}}</option>
                                    @endforeach
                                  </select>
                                </div>
                                <div class="form-group col-3">
                                    <label for="">Quantity *</label>
                                    <input required type="text" class="form-control" value="{{$value['qty']}}" name="qty[]"  placeholder="Product Quantity" >
                                </div>
                                <div class="form-group col-3">
                                    <label for="">MRP *</label>
                                    <input required type="number" class="form-control" value="{{$value['mrp']}}" name="mrp[]"  placeholder="Product MRP" >
                                </div>
                                <div class="form-group col-3">
                                    <label for="">Price *</label>
                                    <input required type="number" class="form-control" value="{{$value['price']}}" name="price[]"  placeholder="Product Slug" >
                                </div>
                                <div class="form-group col-3 d-flex">
                                   
                                    <div> <label for="">Select image *</label>
                                  <input  type="file" class="form-control-file" value="" name="attr_images[]"  placeholder="Product Slug" ></div><a target="_blank" href="{{asset('storage/images/'.$value->image)}}"> <img width="95" height="75" src="{{asset('storage/images/'.$value->image)}}" alt="df"></a>
                                </div>
                                <div class="form-group col-3">
                                    <br>
                                    @if ($v == 1)
                                    <button type="button" onclick="add_attr()" class="btn btn-success w-100"><span style="font-weight:900">Add</span> &nbsp; <i class="fa fa-plus" aria-hidden="true"></i></button>
                                    @else
                                    <a href="/admin_penal/product/manage_product/delete_attr/{{$value['attr_id']}}" type="button"  class="btn btn-danger w-100"><span style="font-weight:900">Remove</span> &nbsp; <i class="fa fa-minus" aria-hidden="true"></i></a>
                                    @endif
                                  
                                </div>

                               
                               
                            
                            <?php
                            $v++;
                       }
                      echo "</div>";
                       }else{
                        ?>
                           <div class="row product_attr_row">
                            <h3 class="mb-0 mt-3">Product Attributes</h2>
                                <hr  style="border:0.1px solid grey; width:100%; margin-top:0px">
                            <div class="form-group col-3">
                                <label for="">SKU *</label>
                                <input required type="number" class="form-control" value="" name="sku[]"  placeholder="Product SKU" >
                            </div>
                            <div class="form-group col-3">
                                <label for="">Select Size</label>
                              <select class="form-control S" name="size[]" id="">
                                <option value="">Select Size</option>
                                @foreach ($size_options as $item)
                                <option value="{{$item->id}}">{{$item->size_name}}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="form-group col-3">
                                <label for="">Select Color</label>
                              <select class="form-control C" name="color[]" id="">
                                <option value="">Select Color</option>
                                @foreach ($color_options as $item)
                                <option value="{{$item->id}}">{{$item->color_name}}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="form-group col-3">
                                <label for="">Quantity *</label>
                                <input required type="text" class="form-control" value="" name="qty[]"  placeholder="Product Quantity" >
                            </div>
                            <div class="form-group col-3">
                                <label for="">MRP *</label>
                                <input required type="number" class="form-control" value="" name="mrp[]"  placeholder="Product MRP" >
                            </div>
                            <div class="form-group col-3">
                                <label for="">Price *</label>
                                <input required type="number" class="form-control" value="" name="price[]"  placeholder="Product Slug" >
                            </div>
                            <div class="form-group col-3">
                                <label for="">Select image *</label>
                              <input required type="file" class="form-control-file" value="" name="attr_images[]"  placeholder="Product Slug" >
                            </div>
                            <div class="form-group col-3">
                                <br>
                               <button type="button" onclick="add_attr()" class="btn btn-success w-100"><span style="font-weight:900">Add</span> &nbsp; <i class="fa fa-plus" aria-hidden="true"></i></button>
                            </div>

                           
                           
                        </div>
                        <?php
                       }
                       ?>
                            {{--  --}}
                                <div class="form-group col-6 mx-auto mt-5">
                                    <input required type="submit" class="btn btn-primary w-100" value="{{$btn_val}}">
                                </div>
                            </form>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
let i = 1;
    let add_attr = () =>{console.log("ff");
      let size_options = document.querySelector(".S").innerHTML;
      let color_options = document.querySelector(".C").innerHTML;
      size_options = size_options.replace("selected","");
      color_options = color_options.replace("selected","");
        let html = `<div class="w-100 row rowNo${i}"><hr style="border:0.1px solid grey; width:100%">
                                <div class="form-group col-3">
                                    <label for="">SKU *</label>
                                    <input required type="number" class="form-control" value="" name="sku[]"  placeholder="Product SKU" >
                                </div>
                                <div class="form-group col-3">
                                    <label for="">Select Size</label>
                                  <select class="form-control" name="size[]" id="">
                                    ${size_options}
                                  </select>
                                </div>
                                <div class="form-group col-3">
                                    <label for="">Select Color</label>
                                  <select class="form-control" name="color[]" id="">
                                   ${color_options}
                                  </select>
                                </div>
                                <div class="form-group col-3">
                                    <label for="">Quantity *</label>
                                    <input required type="text" class="form-control" value="" name="qty[]"  placeholder="Product Quantity" >
                                </div>
                                <div class="form-group col-3">
                                    <label for="">MRP *</label>
                                    <input required type="number" class="form-control" value="" name="mrp[]"  placeholder="Product MRP" >
                                </div>
                                <div class="form-group col-3">
                                    <label for="">Price *</label>
                                    <input required type="number" class="form-control" value="" name="price[]"  placeholder="Product Slug" >
                                </div>
                                <div class="form-group col-3">
                                    <label for="">Select image *</label>
                                  <input required type="file" class="form-control-file" value="" name="attr_images[]"  placeholder="Product Slug" >
                                </div>
                                <div class="form-group col-3">
                                    <br>
                                   <button type="button" onclick="remove_attr(${i})" class="btn btn-danger w-100"><span style="font-weight:900">Remove</span> &nbsp; <i class="fa fa-minus" aria-hidden="true"></i></button>
                                </div></div>`;
                               
                                i++;
                                jQuery(".product_attr_row").append(html);
                              
    }

    let remove_attr = (i)=>{
         document.querySelector(".rowNo"+i).remove();
    }

let j = 0;
    let add_img = () =>{
        
     let img_div =  `<div class="form-group col-2 divno${j}">
        <label for="" class="mb-0">Product other image</label>
        <input hidden type="text" name="forimages[]" value="1" id="">
                    <input @if ($title == "")
                    required    
                    @endif  type="file" class="form-control-file" name="images[]">
                    <button type="button" onclick="remove_img(${j})" class="btn btn-danger btn-sm mt-1"><span style="">Remove</span> &nbsp; <i class="fa fa-minus" aria-hidden="true"></i></button>
                    </div>`;
                    jQuery(".image_row").append(img_div);           
    }
    let remove_img = (j) =>{
        document.querySelector(".divno"+j).remove();
    }
</script>

@endsection