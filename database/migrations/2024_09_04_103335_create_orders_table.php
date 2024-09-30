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
        Schema::create('orders', function (Blueprint $table) {
            $table->string('order_code')->primary();
            $table->foreignId('customer_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('customer_address_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('payment_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('shipment_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->date('order_date');
            $table->integer('shipping_cost');
            $table->string('note');
            $table->bigInteger('total_price');
            $table->enum('status',['Unpaid','Paid']);
            $table->date('payment_date')->nullable();
            $table->enum('shipment_status',['processing','shipping','arrived']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
