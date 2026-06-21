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
      Schema::create('reviews', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id');
        $table->foreign('user_id', 'reviews_user_id_fk')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
        $table->unsignedBigInteger('kamar_id');
        $table->foreign('kamar_id', 'reviews_kamar_id_fk')
            ->references('id')
            ->on('kamars')
            ->onDelete('cascade');
            $table->text('isi_review');
            $table->integer('rating');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
