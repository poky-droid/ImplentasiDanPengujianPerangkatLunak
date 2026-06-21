<?php

namespace Tests\Feature;

use Tests\TestCase;

class OwnerKosControllerTest extends TestCase
{
    public function test_owner_kos_controller_exists()
    {
        $this->assertTrue(class_exists('\App\\Http\\Controllers\\Owner\\KosController'));
    }
}
