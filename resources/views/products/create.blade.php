@extends('products.layout') 
@section('content') 
<div class="container mt-4"> 

    <h2>Add Product</h2> 
    <!-- Create Form --> 
    <form action="{{ route('products.store') }}"  
          method="POST" enctype="multipart/form-data"> 
        @csrf 
        <div class="row"> 
            <!-- Product Name --> 
            <div class="col-md-6 mb-3"> 
                <label>Product Name *</label> 
                <input type="text" name="product_name" class="form-control" required> 
            </div> 
            <!-- Product Price --> 
            <div class="col-md-6 mb-3"> 
                <label>Price *</label> 
                <input type="number" step="0.01" name="price" class="form-control" required> 
            </div> 
            <!-- Product Size --> 
            <div class="col-md-6 mb-3"> 
                <label>Size</label> 
                <input type="text" name="size" class="form-control"> 
            </div> 
            <!-- Product Color --> 
            <div class="col-md-6 mb-3"> 
                <label>Color</label> 
                <input type="text" name="color" class="form-control"> 
            </div> 
            <!-- Product Description --> 
            <div class="col-md-12 mb-3"> 
                <label>Description</label> 
                <textarea name="description" class="form-control"></textarea> 
            </div> 
            <!-- Product Image --> 
            <div class="col-md-12 mb-3"> 
                <label>Product Image</label> 
                <input type="file"  
                       name="image"  
                       class="form-control" 
                       onchange="previewImage(this, 'productPreview')"> 
                <img id="productPreview"  
                     style="width:120px; display:none; margin-top:10px;"> 
            </div> 
            <hr> 

            <!-- SEO Meta Information --> 
            <h4 class="mt-4">SEO Meta Information</h4> 
            <div class="col-md-6 mb-3"> 
                <label>SEO Title</label> 
                <input type="text" name="seo_meta_title" class="form-control"> 
            </div> 
            <div class="col-md-6 mb-3"> 
                <label>SEO Keywords</label> 
                <input type="text" name="seo_meta_key" class="form-control"> 
            </div> 
            <div class="col-md-12 mb-3"> 
                <label>SEO Description</label> 
                <textarea name="seo_meta_description" class="form-control"></textarea> 
            </div> 
            <!-- SEO Meta Image --> 
            <div class="col-md-6 mb-3"> 
                <label>SEO Image</label> 
                <input type="file"  
                       name="seo_meta_image"  
                       class="form-control" 
                       onchange="previewImage(this, 'seoPreview')"> 

                <img id="seoPreview"  
                     style="width:120px; display:none; margin-top:10px;"> 
            </div> 
            <!-- Canonical URL --> 
            <div class="col-md-6 mb-3"> 
                <label>Canonical URL</label> 
                <input type="text" name="seo_canonical" class="form-control"> 
            </div> 
            <hr> 
            <!-- OG Meta Information --> 

            <h4 class="mt-4">Open Graph (OG) Meta</h4> 
            <div class="col-md-6 mb-3"> 
                <label>OG Title</label> 
                <input type="text" name="og_meta_title" class="form-control"> 
            </div> 
            <div class="col-md-6 mb-3"> 
                <label>OG Keywords</label> 
                <input type="text" name="og_meta_key" class="form-control"> 
            </div> 
            <div class="col-md-12 mb-3"> 
                <label>OG Description</label> 
                <textarea name="og_meta_description" class="form-control"></textarea> 
            </div> 

            <!-- OG Image -->
            <div class="col-md-6 mb-3"> 
                <label>OG Image</label> 
                <input type="file"  
                       name="og_meta_image"  
                       class="form-control" 
                       onchange="previewImage(this, 'ogPreview')"> 
                      <img id="ogPreview"  
                     style="width:120px; display:none; margin-top:10px;"> 
            </div> 
            <!-- Product Status --> 
            <div class="col-md-6 mb-3"> 

                <label>Status</label> 

                <select name="status" class="form-control"> 

                    <option value="1">Active</option> 

                    <option value="0">Inactive</option> 
                </select> 
            </div> 
        </div> 
        <button class="btn btn-success mt-3">Submit</button> 
        <a href="{{ route('products.index') }}" class="btn btn-secondary mt-3">Back</a> 
    </form> 
</div> 
<!-- Image Preview Script --> 
<script> 
function previewImage(input, id) { 
    let file = input.files[0]; 
    let reader = new FileReader(); 
    reader.onload = e => { 
        document.getElementById(id).src = e.target.result; 
        document.getElementById(id).style.display = "block"; 
    }; 

    reader.readAsDataURL(file); 

} 
</script> 
@endsection
