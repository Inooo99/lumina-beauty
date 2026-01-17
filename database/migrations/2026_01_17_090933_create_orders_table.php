<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        // Kita simpan string order_id unik (misal: ORD-202601-001) untuk Midtrans
        $table->string('order_number')->unique(); 
        $table->string('customer_name');
        $table->string('customer_email');
        $table->string('customer_phone');
        $table->text('address');
        $table->decimal('total_price', 15, 2);
        // Status: 'pending', 'paid', 'failed'
        $table->enum('status', ['pending', 'paid', 'failed'])->default('pending');
        $table->string('snap_token')->nullable(); // Token dari Midtrans nanti
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
