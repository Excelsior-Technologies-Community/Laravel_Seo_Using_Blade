@extends('products.layout') 

<!-- Set dynamic page title --> 

@section('title', $product->seo_meta_title ?? $product->product_name) 

<!-- SEO & OG META TAGS --> 

@section('meta') 

    <!-- SEO META TAGS --> 

    <meta name="title" content="{{ $product->seo_meta_title }}"> 

    <meta name="description" content="{{ $product->seo_meta_description }}"> 

    <meta name="keywords" content="{{ $product->seo_meta_key }}"> 

    @if($product->seo_canonical) 

        <link rel="canonical" href="{{ $product->seo_canonical }}"> 

    @endif 

    <!-- OPEN GRAPH META TAGS --> 
    <meta property="og:title" content="{{ $product->og_meta_title }}"> 

    <meta property="og:description" content="{{ $product->og_meta_description }}"> 

    <meta property="og:type" content="website"> 

    <meta property="og:url" content="{{ url()->current() }}"> 

    @if($product->og_meta_image) 
        <meta property="og:image" content="{{ asset('images/' . $product->og_meta_image) }}"> 
    @endif 
@endsection 

@section('content') 
<div class="container mt-4"> 

    <h2>Product Details</h2> 

    <hr> 

    <div class="row"> 
        <!-- PRODUCT IMAGE --> 
        <div class="col-md-4"> 
            @if($product->image) 
                <img src="{{ asset('images/' . $product->image) }}"  
                     width="100%" class="img-thumbnail"> 
            @else 
                <div class="alert alert-warning">No image available</div> 
            @endif 

        </div> 
        <!-- PRODUCT DETAILS --> 
        <div class="col-md-8"> 

            <h3>{{ $product->product_name }}</h3> 

            <p><strong>Price:</strong> ₹{{ $product->price }}</p> 

            <p><strong>Size:</strong> {{ $product->size }}</p> 

            <p><strong>Color:</strong> {{ $product->color }}</p> 

            <hr> 

            <h5>Description</h5> 

            <p>{{ $product->description }}</p> 

            <hr> 
            <!-- SEO SECTION --> 
            <h5>SEO Meta Information</h5> 
            <p><strong>SEO Title:</strong> {{ $product->seo_meta_title }}</p> 

            <p><strong>SEO Keywords:</strong> {{ $product->seo_meta_key }}</p> 

            <p><strong>SEO Description:</strong> {{ $product->seo_meta_description }}</p> 

            <p><strong>Canonical URL:</strong> {{ $product->seo_canonical }}</p> 

            @if($product->seo_meta_image) 
                <p><strong>SEO Image:</strong></p> 
                <img src="{{ asset('images/' . $product->seo_meta_image) }}" width="200"> 
            @endif 

            <hr> 
            <!-- OG SECTION --> 
            <h5>Open Graph (OG) Meta Information</h5> 

            <p><strong>OG Title:</strong> {{ $product->og_meta_title }}</p> 

            <p><strong>OG Keywords:</strong> {{ $product->og_meta_key }}</p> 

            <p><strong>OG Description:</strong> {{ $product->og_meta_description }}</p> 

            @if($product->og_meta_image) 
                <p><strong>OG Image:</strong></p> 
                <img src="{{ asset('images/' . $product->og_meta_image) }}" width="200"> 
            @endif 
            <hr> 
            <!-- ACTION BUTTONS --> 
            <a href="{{ route('products.edit', $product->id) }}"  
               class="btn btn-warning">Edit</a> 
            <a href="{{ route('products.index') }}"  
               class="btn btn-secondary">Back</a> 
        </div> 
    </div> 
