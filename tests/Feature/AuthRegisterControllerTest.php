<?php

namespace Tests\Feature;

use Tests\TestCase;

class AuthRegisterControllerTest extends TestCase
{
    public function test_register_controller_exists()
    {
        $this->assertTrue(class_exists('\App\\Http\\Controllers\\Auth\\RegisterController'));
    }
}
