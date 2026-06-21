<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('favorit', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('kos_id')->constrained('kos')->onDelete('cascade');
            $table->timestamps();

            // Satu user hanya bisa favorit satu kos satu kali
            $table->unique(['user_id', 'kos_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('favorit');
    }
};
