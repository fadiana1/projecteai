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
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('tani_id');
            $table->foreign('tani_id')->references('id')->on('tanis')->onDelete('cascade');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('harga');
            $table->enum('status', ['publish', 'draft']);
            $table->string('stock');
            $table->string('image');
            $table->longText('body');
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
        Schema::dropIfExists('products');
    }
};
