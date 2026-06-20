<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('kos', function (Blueprint $table) {
            $table->string('status')->default('aktif'); // aktif | nonaktif
        });
    }

    public function down(): void
    {
        Schema::table('kos', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
