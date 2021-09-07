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
            $table->foreignId('customer_id')->constrained('customers');
            $table->foreignId('product_category_id')->constrained('products_categories');
            $table->foreignId('category_id')->constrained('categories');
            $table->foreignId('manufacturer_id')->constrained(('manufacturers'));
            $table->text('product_title');
            $table->text('product_seo_description');
            $table->text('product_url');
            $table->text('product_image1');
            $table->text('product_image2');
            $table->text('product_image3');
            $table->decimal('product_price', 10, 2);
            $table->decimal('product_sale_price', 10, 2);
            $table->text('product_description');
            $table->text('product_features');
            $table->text('product_featured');
            $table->text('product_video');
            $table->text('product_keywords');
            $table->text('product_label');
            $table->decimal('product_weight', 10, 2);
            $table->integer('product_top')->default(0);
            $table->text('product_views');
            $table->text('product_vendor_status');
            $table->text('product_status');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
