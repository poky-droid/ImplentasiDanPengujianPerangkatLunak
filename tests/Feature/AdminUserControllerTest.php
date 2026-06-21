<?php

namespace Tests\Feature;

use Tests\TestCase;

class AdminUserControllerTest extends TestCase
{
    public function test_admin_user_controller_exists()
    {
        $this->assertTrue(class_exists('\App\\Http\\Controllers\\Admin\\UserController'));
    }
}
