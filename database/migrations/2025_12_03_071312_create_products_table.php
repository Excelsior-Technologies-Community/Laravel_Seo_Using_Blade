<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('product_name');
            $table->string('image')->nullable();
            $table->decimal('price', 10, 2);
            $table->string('size')->nullable();
            $table->string('color')->nullable();
            $table->text('description')->nullable();

            $table->string('seo_meta_title')->nullable();
            $table->text('seo_meta_description')->nullable();
            $table->string('seo_meta_key')->nullable();
            $table->string('seo_meta_image')->nullable();
            $table->string('seo_canonical')->nullable();

            $table->string('og_meta_title')->nullable();
            $table->text('og_meta_description')->nullable();
            $table->string('og_meta_key')->nullable();
            $table->string('og_meta_image')->nullable();

            $table->boolean('status')->default(1);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
