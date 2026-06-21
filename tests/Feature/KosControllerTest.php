<?php

namespace Tests\Feature;

use Tests\TestCase;

class KosControllerTest extends TestCase
{
    public function test_kos_controller_exists()
    {
        $this->assertTrue(class_exists('\App\\Http\\Controllers\\KosController'));
    }
}
