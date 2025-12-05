<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'image',
        'price',
        'size',
        'color',
        'description',

        'seo_meta_title',
        'seo_meta_description',
        'seo_meta_key',
        'seo_meta_image',
        'seo_canonical',

        'og_meta_title',
        'og_meta_description',
        'og_meta_key',
        'og_meta_image',

        'status',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'status' => 'boolean',
    ];
}
