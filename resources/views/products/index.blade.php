@extends('products.layout') 
@section('content') 
<div class="container mt-4"> 

    <!-- Display Success Message --> 
    @if(session('success')) 
        <div class="alert alert-success">{{ session('success') }}</div> 
    @endif 

    <div class="d-flex justify-content-between mb-3"> 
        <h2>Products</h2> 
        <a href="{{ route('products.create') }}" class="btn btn-primary">Add Product</a> 
    </div> 

    <!-- Product Table --> 
    <table class="table table-bordered table-striped"> 
        <thead> 
            <tr> 
                <th>#ID</th> 

                <th>Image</th> 

                <th>Name</th> 

                <th>Price</th> 

                <th>Size</th> 

                <th>Color</th> 

                <th>Description</th> 

                <th>Status</th> 

                <th width="180">Actions</th> 
            </tr> 
        </thead> 
        <tbody> 
            @forelse($products as $product) 
                <tr> 
                    <td>{{ $product->id }}</td> 

                    <!-- Product Image --> 
                    <td> 
                        @if($product->image) 
                            <img src="{{ asset('images/' . $product->image) }}" width="60"> 
                        @else 
                            <span>No Image</span> 
                        @endif 
                    </td> 

                    <td>{{ $product->product_name }}</td> 

                    <td>{{ $product->price }}</td> 

                    <td>{{ $product->size }}</td> 

                    <td>{{ $product->color }}</td> 

                    <!-- Short Description --> 
                    <td style="max-width: 200px;"> 
                        {{ \Illuminate\Support\Str::limit($product->description, 50, '...') }} 
                    </td> 

                    <!-- Status Badge --> 
                    <td> 
                        @if($product->status) 
                            <span class="badge bg-success">Active</span> 
                        @else 
                            <span class="badge bg-danger">Inactive</span> 
                        @endif 
                    </td> 
                    <td> 
                        <!-- Show Button --> 
                        <a href="{{ route('products.show', $product->id) }}"  
                           class="btn btn-info btn-sm text-white">Show</a> 
                        <!-- Edit Button --> 
                        <a href="{{ route('products.edit', $product->id) }}"  
                           class="btn btn-warning btn-sm">Edit</a> 
                        <!-- Delete Form --> 
                        <form action="{{ route('products.destroy', $product->id) }}" 
                              method="POST" style="display:inline-block;"> 
                            @csrf 
                            @method('DELETE') 
                            <button class="btn btn-danger btn-sm" 
                                onclick="return confirm('Are you sure you want to delete this product?')"> 
                                Delete 
                            </button> 
                        </form> 
                    </td> 
                </tr> 
            @empty 
                <tr> 
                    <td colspan="10" class="text-center">No products available</td> 
                </tr> 
            @endforelse 
        </tbody> 
    </table> 
    <!-- Pagination Links --> 
    {{ $products->links() }} 
</div> 
@endsection
