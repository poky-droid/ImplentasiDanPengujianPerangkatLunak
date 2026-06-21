<?php

namespace Tests\Feature;

use Tests\TestCase;

class AdminPengajuanMitraControllerTest extends TestCase
{
    public function test_admin_pengajuan_mitra_controller_exists()
    {
        $this->assertTrue(class_exists('\App\\Http\\Controllers\\Admin\\PengajuanMitraController'));
    }
}
