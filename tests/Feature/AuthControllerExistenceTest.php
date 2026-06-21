<?php

namespace Tests\Feature;

use Tests\TestCase;

class AuthControllerExistenceTest extends TestCase
{
    public function test_auth_controller_exists()
    {
        $this->assertTrue(class_exists('\App\\Http\\Controllers\\AuthController'));
    }
}
