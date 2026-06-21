<?php

namespace Tests\Feature;

use Tests\TestCase;

class AdminKomplainControllerTest extends TestCase
{
    public function test_admin_komplain_controller_exists()
    {
        $this->assertTrue(class_exists('\App\\Http\\Controllers\\Admin\\KomplainController'));
    }
}
