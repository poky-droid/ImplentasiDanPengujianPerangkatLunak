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
        Schema::table('bookings', function (Blueprint $table) {
            $table->unsignedBigInteger('kos_id')->nullable()->after('user_id');
            $table->date('tanggal_mulai')->nullable()->after('kos_id');
            $table->integer('durasi')->nullable()->after('tanggal_mulai');
            $table->bigInteger('total')->nullable()->after('durasi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
        $table->dropColumn(['kos_id', 'tanggal_mulai', 'durasi', 'total']);
        });
    }
};
