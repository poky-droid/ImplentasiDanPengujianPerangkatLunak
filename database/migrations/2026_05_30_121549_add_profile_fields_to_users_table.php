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
        Schema::table('users', function (Blueprint $table) {
            $table->string('jenis_kelamin')->nullable()->after('phone');
            $table->date('tanggal_lahir')->nullable()->after('jenis_kelamin');
            $table->string('pekerjaan')->nullable()->after('tanggal_lahir');
            $table->string('kota_asal')->nullable()->after('pekerjaan');
            $table->string('status')->nullable()->after('kota_asal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
