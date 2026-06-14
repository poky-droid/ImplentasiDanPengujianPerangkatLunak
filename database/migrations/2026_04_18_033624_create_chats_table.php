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
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sender_id');    // user yang kirim pesan
            $table->unsignedBigInteger('receiver_id');  // user yang terima pesan (owner kos)
            $table->unsignedBigInteger('kos_id');       // kos yang dibicarakan
            $table->text('pesan');
            $table->boolean('dibaca')->default(false);
            $table->timestamps();
 
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('receiver_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('kos_id')->references('id')->on('kos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
