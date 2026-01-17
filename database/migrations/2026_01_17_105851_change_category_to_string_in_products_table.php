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
    Schema::table('products', function (Blueprint $table) {
        // Ubah dari ENUM ke STRING agar bisa menampung 'brightening', dll
        $table->string('category', 255)->change();
    });
}

public function down()
{
    Schema::table('products', function (Blueprint $table) {
        // Kembalikan ke ENUM (Jika rollback)
        // Perlu mendefinisikan ulang list enum lama atau biarkan string
        // Untuk aman, kita biarkan string atau definisikan ulang:
        // $table->enum('category', ['skincare', 'makeup', 'body_care'])->change();
    });
}
};
