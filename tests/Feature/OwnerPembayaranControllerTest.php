<?php

namespace Tests\Feature;

use Tests\TestCase;

class OwnerPembayaranControllerTest extends TestCase
{
    public function test_owner_pembayaran_controller_exists()
    {
        $this->assertTrue(class_exists('\App\\Http\\Controllers\\Owner\\PembayaranController'));
    }
}
