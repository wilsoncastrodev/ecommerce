<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('products_categories', function (Blueprint $table) {
            $table->id();
            $table->text('product_category_title');
            $table->text('product_category_top');
            $table->text('product_category_image');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('products_categories');
    }
}
