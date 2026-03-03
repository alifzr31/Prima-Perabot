<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkout_items', function (Blueprint $table) {
            $table->id();
            $table->uuid('checkout_id');
            $table->uuid('product_id')->nullable();
            $table->string('product_name');
            $table->unsignedBigInteger('price');
            $table->unsignedTinyInteger('discount_percent')->default(0);
            $table->unsignedBigInteger('discount_amount')->default(0);
            $table->unsignedInteger('qty');
            $table->unsignedBigInteger('subtotal');


            $table->foreign('checkout_id')
                ->references('id')
                ->on('checkouts')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->index('checkout_id');
            $table->index('product_id');
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
        Schema::dropIfExists('checkout_items');
    }
};
