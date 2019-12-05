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
            $table->increments('id');
            $table->integer('customer_id', 0,1);
            $table->string('issn');
            $table->string('name');
            $table->enum('status', ['new', 'pending', 'in review', 'approved', 'inactive', 'deleted'])
                ->default('new');
            $table->timestamps();
            $table->softDeletes();

            //Foreing keys
            $table->foreign('customer_id')
                ->on('customers')
                ->references('id')
                ->onDelete('cascade');

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
