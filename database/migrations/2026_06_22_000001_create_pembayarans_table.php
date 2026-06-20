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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('booking_id');
            $table->foreign('booking_id', 'pembayarans_booking_id_fk')
                ->references('id')
                ->on('bookings')
                ->onDelete('cascade');
                
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'pembaran_user_id_fk')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
                
            $table->unsignedBigInteger('kos_id');
            $table->foreign('kos_id', 'pembayarans_kos_id_fk')
                ->references('id')
                ->on('kos')
                ->onDelete('cascade');

            $table->string('metode_pembayaran');
            $table->string('status_pembayaran');
            $table->dateTime('tanggal_pembayaran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
