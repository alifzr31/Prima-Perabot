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
        Schema::create('checkouts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('order_number')->unique();
            $table->string('orderer_name');
            $table->string('orderer_email');
            $table->string('orderer_phone');
            $table->string('receiver_name');
            $table->text('receiver_address');
            $table->string('receiver_country');
            $table->string('receiver_province');
            $table->string('receiver_city');
            $table->string('receiver_district');
            $table->string('receiver_sub_district');
            $table->string('receiver_postal_code');
            $table->text('notes')->nullable();
            $table->unsignedBigInteger('subtotal');
            $table->unsignedBigInteger('total_discount_amount')->default(0);
            $table->unsignedBigInteger('grand_total');
            $table->enum('status', ['pending', 'paid', 'cancelled', 'returned', 'completed'])->default('pending');
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
        Schema::dropIfExists('checkouts');
    }
};
