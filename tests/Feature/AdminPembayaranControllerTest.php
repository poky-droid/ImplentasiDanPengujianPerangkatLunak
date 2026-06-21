<?php

namespace Tests\Feature;

use Tests\TestCase;

class AdminPembayaranControllerTest extends TestCase
{
    public function test_admin_pembayaran_controller_exists()
    {
        $this->assertTrue(class_exists('\App\\Http\\Controllers\\Admin\\PembayaranController'));
    }
}
