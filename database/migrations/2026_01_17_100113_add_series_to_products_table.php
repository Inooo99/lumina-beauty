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
        // Kita tambah kolom series, boleh kosong (nullable) kalau produk umum
        $table->enum('series', ['brightening', 'anti_aging', 'acne_care', 'none'])->default('none')->after('category');
    });
}

public function down()
{
    Schema::table('products', function (Blueprint $table) {
        $table->dropColumn('series');
    });
}
};
