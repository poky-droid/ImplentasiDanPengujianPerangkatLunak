<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('owner_id')->nullable();
            $table->string('nama');
            $table->string('alamat');
            $table->text('deskripsi')->nullable();
            $table->integer('harga');
            $table->string('tipe')->default('putri'); // putri | putra | campur
            $table->string('luas_kamar')->nullable();
            $table->string('kamar_mandi')->default('dalam');
            $table->json('fasilitas')->nullable();
            $table->json('foto')->nullable();
            $table->integer('kamar_tersedia')->default(0);
            $table->float('rating')->nullable();
            $table->boolean('is_eksklusif')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kos');
    }
};