<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // -------------------------------
    // SHOW PRODUCT LIST PAGE (PAGINATION)
    // -------------------------------
    public function index()
    {
        // Fetch latest products with pagination (10 per page)
        $products = Product::latest()->paginate(10);

        // Load products.index blade file
        return view('products.index', compact('products'));
    }

    // -------------------------------
    // SHOW CREATE FORM
    // -------------------------------
    public function create()
    {
        // Simply return product creation form
        return view('products.create');
    }

    // -------------------------------
    // STORE NEW PRODUCT
    // -------------------------------
    public function store(Request $request)
    {
        // Validate all input fields
        $request->validate([
            'product_name'    => 'required|regex:/^[A-Za-z\s]+$/',   // Only alphabets allowed
            'color'           => 'nullable|regex:/^[A-Za-z\s]+$/',   // Optional but must be letters
            'price'           => 'required|numeric',                 // Only numbers allowed
            'image'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'seo_meta_image'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'og_meta_image'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // -------------------------------
        // MAIN PRODUCT IMAGE UPLOAD
        // -------------------------------
        $mainImage = null;
        if ($request->hasFile('image')) {
            // Make unique name
            $mainImage = 'product_' . time() . '.' . $request->image->extension();

            // Move file to public/images folder
            $request->image->move(public_path('images'), $mainImage);
        }

        // -------------------------------
        // SEO META IMAGE UPLOAD
        // -------------------------------
        $seoImage = null;
        if ($request->hasFile('seo_meta_image')) {
            $seoImage = 'seo_' . time() . '.' . $request->seo_meta_image->extension();
            $request->seo_meta_image->move(public_path('images'), $seoImage);
        }

        // -------------------------------
        // OG META IMAGE UPLOAD
        // -------------------------------
        $ogImage = null;
        if ($request->hasFile('og_meta_image')) {
            $ogImage = 'og_' . time() . '.' . $request->og_meta_image->extension();
            $request->og_meta_image->move(public_path('images'), $ogImage);
        }

        // -------------------------------
        // STORE PRODUCT IN DATABASE
        // -------------------------------
        Product::create([
            'product_name'         => $request->product_name,
            'image'                => $mainImage,
            'price'                => $request->price,
            'size'                 => $request->size,
            'color'                => $request->color,
            'description'          => $request->description,

            // SEO data
            'seo_meta_title'       => $request->seo_meta_title,
            'seo_meta_description' => $request->seo_meta_description,
            'seo_meta_key'         => $request->seo_meta_key,
            'seo_meta_image'       => $seoImage,
            'seo_canonical'        => $request->seo_canonical,

            // OG data
            'og_meta_title'        => $request->og_meta_title,
            'og_meta_description'  => $request->og_meta_description,
            'og_meta_key'          => $request->og_meta_key,
            'og_meta_image'        => $ogImage,

            'status'               => $request->status ?? 1, // Default active
        ]);

        return redirect()->route('products.index')->with('success', 'Product Added Successfully');
    }

    // -------------------------------
    // EDIT PRODUCT PAGE
    // -------------------------------
    public function edit($id)
    {
        // Find product by ID or fail
        $product = Product::findOrFail($id);

        return view('products.edit', compact('product'));
    }

    // -------------------------------
    // SHOW PRODUCT DETAILS
    // -------------------------------
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('products.show', compact('product'));
    }

    // -------------------------------
    // UPDATE EXISTING PRODUCT
    // -------------------------------
    public function update(Request $request, $id)
    {
        // Validation rules
        $request->validate([
            'product_name'    => 'required|regex:/^[A-Za-z\s]+$/',
            'color'           => 'nullable|regex:/^[A-Za-z\s]+$/',
            'price'           => 'required|numeric',
            'image'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'seo_meta_image'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'og_meta_image'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Fetch product from DB
        $product = Product::findOrFail($id);

        // -------------------------------
        // UPDATE MAIN IMAGE IF NEW FILE
        // -------------------------------
        $mainImage = $product->image;
        if ($request->hasFile('image')) {

            // Delete old image
            if ($mainImage && file_exists(public_path('images/' . $mainImage))) {
                unlink(public_path('images/' . $mainImage));
            }

            // Upload new image
            $mainImage = 'product_' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $mainImage);
        }

        // -------------------------------
        // UPDATE SEO IMAGE
        // -------------------------------
        $seoImage = $product->seo_meta_image;
        if ($request->hasFile('seo_meta_image')) {

            if ($seoImage && file_exists(public_path('images/' . $seoImage))) {
                unlink(public_path('images/' . $seoImage));
            }

            $seoImage = 'seo_' . time() . '.' . $request->seo_meta_image->extension();
            $request->seo_meta_image->move(public_path('images'), $seoImage);
        }

        // -------------------------------
        // UPDATE OG IMAGE
        // -------------------------------
        $ogImage = $product->og_meta_image;
        if ($request->hasFile('og_meta_image')) {

            if ($ogImage && file_exists(public_path('images/' . $ogImage))) {
                unlink(public_path('images/' . $ogImage));
            }

            $ogImage = 'og_' . time() . '.' . $request->og_meta_image->extension();
            $request->og_meta_image->move(public_path('images'), $ogImage);
        }

        // -------------------------------
        // UPDATE PRODUCT IN DATABASE
        // -------------------------------
        $product->update([
            'product_name'         => $request->product_name,
            'image'                => $mainImage,
            'price'                => $request->price,
            'size'                 => $request->size,
            'color'                => $request->color,
            'description'          => $request->description,

            // SEO
            'seo_meta_title'       => $request->seo_meta_title,
            'seo_meta_description' => $request->seo_meta_description,
            'seo_meta_key'         => $request->seo_meta_key,
            'seo_meta_image'       => $seoImage,
            'seo_canonical'        => $request->seo_canonical,

            // OG
            'og_meta_title'        => $request->og_meta_title,
            'og_meta_description'  => $request->og_meta_description,
            'og_meta_key'          => $request->og_meta_key,
            'og_meta_image'        => $ogImage,

            'status'               => $request->status ?? 1,
        ]);

        return redirect()->route('products.index')->with('success', 'Product Updated Successfully');
    }

    // -------------------------------
    // DELETE PRODUCT + IMAGES
    // -------------------------------
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // All possible image paths
        $files = [
            $product->image,
            $product->seo_meta_image,
            $product->og_meta_image
        ];

        // Delete files from folder
        foreach ($files as $file) {
            if ($file && file_exists(public_path('images/' . $file))) {
                unlink(public_path('images/' . $file));
            }
        }

        // Delete product record
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product Deleted Successfully');
    }
}
