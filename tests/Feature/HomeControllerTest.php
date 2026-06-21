<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    public function test_home_controller_exists()
    {
        $this->assertTrue(class_exists('\App\\Http\\Controllers\\HomeController'));
    }
}
