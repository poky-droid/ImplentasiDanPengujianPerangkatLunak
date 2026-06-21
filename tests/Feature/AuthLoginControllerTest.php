<?php

namespace Tests\Feature;

use Tests\TestCase;

class AuthLoginControllerTest extends TestCase
{
    public function test_login_controller_exists()
    {
        $this->assertTrue(class_exists('\App\\Http\\Controllers\\Auth\\LoginController'));
    }
    
}
