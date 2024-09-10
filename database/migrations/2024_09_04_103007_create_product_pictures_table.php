<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_pictures', function (Blueprint $table) {
            $table->id();
            $table->string('product_variant_code');
            $table->foreign('product_variant_code')->references('product_variant_code')->on('product_variants')->onUpdate('cascade')->onDelete('cascade');
            $table->string('directory');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_pictures');
    }
};
