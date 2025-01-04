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
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('inv')->unique();
            $table->uuid('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

            $table->string('name');
            $table->string('phone');
            $table->text('alamat');
            //$table->string('pembayaran');

            $table->string('jumlah');
            $table->string('harga');

            $table->enum('payment', ['pending', 'aprove', 'gagal']);
            $table->enum('pengiriman', ['cod', 'expedisi']);
            $table->enum('status', ['pending', 'proses', 'mengirim', 'selesai']);
            $table->string('expedisi')->nullable();
            $table->string('image')->nullable();

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
        Schema::dropIfExists('orders');
    }
};
