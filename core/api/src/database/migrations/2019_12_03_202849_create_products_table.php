<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->integer('id', 1);
            $table->integer('customer_id')->unique();
            $table->string('issn');
            $table->string('name');
            $table->enum('status', ['new', 'pending', 'in review', 'approved', 'inactive', 'deleted']);
            $table->timestamps();
            $table->softDeletes();

            //Foreing keys
            $table->foreign('customer_id')->on('customers')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
