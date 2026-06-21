<?php

namespace Tests\Feature;

use Tests\TestCase;

class ProfileControllerTest extends TestCase
{
    public function test_profile_controller_exists()
    {
        $this->assertTrue(class_exists('\App\\Http\\Controllers\\ProfileController'));
    }
}
