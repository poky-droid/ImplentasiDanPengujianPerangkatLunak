<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Menambahkan:
     * - reference_id: ID referensi ke entitas terkait (booking, chat, dll.)
     * - reference_type: Tipe model referensi (opsional, untuk polymorphic)
     * Serta memperluas tipe notifikasi dengan 'maintenance' dan 'chat'.
     *
     * Catatan: MySQL tidak support ALTER COLUMN untuk mengubah ENUM secara
     * langsung tanpa DROP & RE-CREATE. Kita gunakan DB::statement().
     */
    public function up(): void
    {
        Schema::table('owner_notifications', function (Blueprint $table) {
            // Referensi ke entitas terkait (booking_id, chat kos_id, dll.)
            $table->unsignedBigInteger('reference_id')->nullable()->after('tipe');
            $table->string('reference_type')->nullable()->after('reference_id'); // e.g. 'booking', 'chat', 'kos'
        });

        // Perluas ENUM tipe supaya mendukung 'maintenance' dan 'chat'
        \DB::statement("ALTER TABLE owner_notifications MODIFY COLUMN tipe ENUM('booking','pembayaran','review','sistem','maintenance','chat') NOT NULL DEFAULT 'sistem'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('owner_notifications', function (Blueprint $table) {
            $table->dropColumn(['reference_id', 'reference_type']);
        });

        // Kembalikan ENUM ke nilai semula
        \DB::statement("ALTER TABLE owner_notifications MODIFY COLUMN tipe ENUM('booking','pembayaran','review','sistem') NOT NULL DEFAULT 'sistem'");
    }
};
