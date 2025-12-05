<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 

    <!-- Responsive layout --> 

    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 

    <!-- Default page title (child pages can override this) --> 

    <title>@yield('title', 'Product CRUD')</title> 

    <!-- SEO + OG META TAGS will be injected from child views --> 

    @yield('meta') 

    <!-- Bootstrap CSS CDN --> 

    <link rel="stylesheet"  

          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"> 

    <style> 
        body { 

            background: #f8f9fa; 

        } 
        .navbar { 

            margin-bottom: 20px; 

        } 
    </style> 
</head> 
<body> 

    <!-- Navigation Bar --> 

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4"> 

        <a class="navbar-brand" href="{{ url('/') }}">My Shop</a> 

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu"> 

            <span class="navbar-toggler-icon"></span> 

        </button> 

        <div class="collapse navbar-collapse" id="navMenu"> 

            <ul class="navbar-nav ms-auto"> 

                <!-- Product List Link --> 

                <li class="nav-item"> 

                    <a href="{{ route('products.index') }}" class="nav-link">Products</a> 

                </li> 

                <!-- Add New Product --> 

                <li class="nav-item"> 

                    <a href="{{ route('products.create') }}" class="nav-link">Add Product</a> 

                </li> 
            </ul> 

        </div> 

    </nav> 
    <!-- Main Content Area (Child views insert content here) --> 
    <div class="container"> 
        @yield('content') 
    </div> 
    <!-- Bootstrap JS CDN --> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> 

</body> 

</html>
