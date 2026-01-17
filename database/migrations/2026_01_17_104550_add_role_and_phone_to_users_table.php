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
    Schema::table('users', function (Blueprint $table) {
        // Menambahkan kolom role dengan default 'customer'
        $table->enum('role', ['admin', 'customer'])->default('customer')->after('email');
        
        // Menambahkan no hp dan alamat (opsional tapi berguna)
        $table->string('phone')->nullable()->after('role');
        $table->text('address')->nullable()->after('phone');
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['role', 'phone', 'address']);
    });
}
};
