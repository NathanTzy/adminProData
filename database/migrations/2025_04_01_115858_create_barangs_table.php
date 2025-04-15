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
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();  // Primary key
            $table->string('name');  // Nama barang
            $table->decimal('price', 10, 2);  // Harga barang (contoh: 99999999.99)
            $table->integer('quantity');  // Jumlah stok barang
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();  // Timestamp created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
