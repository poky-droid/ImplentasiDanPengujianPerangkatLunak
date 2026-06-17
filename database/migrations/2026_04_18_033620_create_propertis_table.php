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
        Schema::create('propertis', function (Blueprint $table) {
            $table->id();
            // define owner_id and give the foreign key an explicit unique name
            $table->unsignedBigInteger('owner_id');
            $table->foreign('owner_id', 'propertis_owner_id_fk')
                  ->references('id')
                  ->on('owners')
                  ->onDelete('cascade');
            $table->string('nama');
            $table->string('lokasi');
            $table->text('fasilitas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('propertis');
    }
};
