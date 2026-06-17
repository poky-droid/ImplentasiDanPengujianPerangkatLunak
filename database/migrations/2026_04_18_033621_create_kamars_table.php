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
        Schema::create('kamars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('properti_id');
            $table->foreign('properti_id', 'kamars_properti_id_fk')
                  ->references('id')
                  ->on('propertis')
                  ->onDelete('cascade');
            $table->integer('harga');
            $table->enum('status',['tersedia','terisi']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kamars');
    }
};
