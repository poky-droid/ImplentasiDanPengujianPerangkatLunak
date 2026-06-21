<?php

namespace Tests\Feature;

use Tests\TestCase;

class NotifikasiControllerTest extends TestCase
{
    public function test_notifikasi_controller_exists()
    {
        $this->assertTrue(class_exists('\App\\Http\\Controllers\\NotifikasiController'));
    }
}
