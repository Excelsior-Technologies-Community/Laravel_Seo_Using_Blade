@extends('products.layout') 
@section('content') 
<div class="container mt-4"> 
    <h2>Edit Product</h2> 
    <!-- Update Form --> 
    <form action="{{ route('products.update', $product->id) }}"  
          method="POST" enctype="multipart/form-data"> 

        @csrf 

        @method('PUT') 

        <div class="row"> 
            <!-- Product Name --> 
            <div class="col-md-6 mb-3"> 
                <label>Product Name *</label> 
                <input type="text" name="product_name"  
                       value="{{ $product->product_name }}" 
                       class="form-control" required> 
            </div> 
            <!-- Price --> 
            <div class="col-md-6 mb-3"> 
                <label>Price *</label> 
                <input type="number" step="0.01"  
                       name="price"  
                       value="{{ $product->price }}" 
                       class="form-control" required> 
            </div> 
            <!-- Size --> 
            <div class="col-md-6 mb-3"> 
                <label>Size</label> 
                <input type="text"  
                       name="size"  
                       value="{{ $product->size }}" 
                       class="form-control"> 
            </div> 
            <!-- Color --> 
            <div class="col-md-6 mb-3"> 
                <label>Color</label> 
                <input type="text"  
                       name="color"  
                       value="{{ $product->color }}" 
                       class="form-control"> 
            </div> 
            <!-- Description --> 
            <div class="col-md-12 mb-3"> 
                <label>Description</label> 
                <textarea name="description"  
                          class="form-control">{{ $product->description }}</textarea> 
            </div> 
            <!-- Current Image --> 
            <div class="col-md-12 mb-2"> 
                <label>Current Image:</label><br> 
                @if($product->image) 
                    <img src="{{ asset('images/' . $product->image) }}" width="100"> 
                @endif 
            </div> 
            <!-- Upload New Image --> 
            <div class="col-md-12 mb-3"> 
                <label>Change Image</label> 
                <input type="file"  
                       name="image"  
                       class="form-control" 
                       onchange="previewImage(this, 'previewProduct')"> 
                <img id="previewProduct"  
                     style="width:120px; display:none; margin-top:10px;"> 
            </div> 
            <hr> 
            <!-- SEO Fields --> 
            <h4>SEO Meta Information</h4> 
            <div class="col-md-6 mb-3"> 
                <label>SEO Title</label> 
                <input type="text"  
                       name="seo_meta_title"  
                       value="{{ $product->seo_meta_title }}" 
                       class="form-control"> 
            </div> 
            <div class="col-md-6 mb-3"> 
                <label>SEO Keywords</label> 
                <input type="text"  
                       name="seo_meta_key"  
                       value="{{ $product->seo_meta_key }}" 
                       class="form-control"> 
            </div> 
            <div class="col-md-12 mb-3"> 
                <label>SEO Description</label> 
                <textarea name="seo_meta_description"  
                        class="form-control">{{ $product->seo_meta_description }}</textarea> 
            </div> 
            <!-- Current SEO Image --> 
            <div class="col-md-6 mb-2"> 
                <label>Current SEO Image:</label><br> 
                @if($product->seo_meta_image) 
                    <img src="{{ asset('images/' . $product->seo_meta_image) }}" width="100"> 
                @endif 
            </div> 
            <!-- Upload New SEO Image --> 
            <div class="col-md-6 mb-3"> 
                <label>Change SEO Image</label> 
                <input type="file"  
                       name="seo_meta_image"  
                       class="form-control" 
                       onchange="previewImage(this, 'previewSeo')"> 
                <img id="previewSeo"  
                     style="width:120px; display:none; margin-top:10px;"> 
            </div> 
            <!-- Canonical URL --> 
            <div class="col-md-6 mb-3"> 
                <label>Canonical URL</label> 
                <input type="text"  
                       name="seo_canonical" 
                       value="{{ $product->seo_canonical }}" 
                       class="form-control"> 
            </div> 
            <hr> 
            <!-- OG Section --> 
            <h4>Open Graph (OG) Meta Information</h4> 
            <div class="col-md-6 mb-3"> 
                <label>OG Title</label> 
                <input type="text"  
                       name="og_meta_title" 
                       value="{{ $product->og_meta_title }}" 
                       class="form-control"> 
            </div> 
            <div class="col-md-6 mb-3"> 
                <label>OG Keywords</label> 
                <input type="text"  
                       name="og_meta_key" 
                       value="{{ $product->og_meta_key }}" 
                       class="form-control"> 
            </div> 
            <div class="col-md-12 mb-3"> 
                <label>OG Description</label> 
                <textarea name="og_meta_description"  
                          class="form-control">{{ $product->og_meta_description }}</textarea> 
            </div> 

            <!-- Current OG Image --> 
            <div class="col-md-6 mb-2"> 
                <label>Current OG Image:</label><br> 
                @if($product->og_meta_image) 
                    <img src="{{ asset('images/' . $product->og_meta_image) }}" width="100"> 
                @endif 
            </div> 
            <!-- Upload New OG Image --> 
            <div class="col-md-6 mb-3"> 
                <label>Change OG Image</label> 
                <input type="file"  
                       name="og_meta_image"  
                       class="form-control" 
                       onchange="previewImage(this, 'previewOg')"> 
                <img id="previewOg"  
                     style="width:120px; display:none; margin-top:10px;"> 
            </div> 
            <!-- Product Status --> 
            <div class="col-md-6 mb-3"> 
                <label>Status</label> 
                <select name="status" class="form-control"> 
                    <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Active</option> 
                    <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>Inactive</option> 
                </select> 
            </div> 
        </div> 
        <button class="btn btn-success mt-3">Update</button> 
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
