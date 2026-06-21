<?php

namespace Tests\Feature;

use Tests\TestCase;

class AdminOwnerControllerTest extends TestCase
{
    public function test_admin_owner_controller_exists()
    {
        $this->assertTrue(class_exists('\App\\Http\\Controllers\\Admin\\OwnerController'));
    }
}
