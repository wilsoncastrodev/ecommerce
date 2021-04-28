<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained(('customers'));
            $table->string('zipcode');
            $table->string('address');
            $table->integer('number');
            $table->string('complement');
            $table->string('neighbourhood');
            $table->string('city');
            $table->string('state');
            $table->string('reference');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers_addresses');
    }
}
