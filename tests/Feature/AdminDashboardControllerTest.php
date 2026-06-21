<?php

namespace Tests\Feature;

use Tests\TestCase;

class AdminDashboardControllerTest extends TestCase
{
    public function test_admin_dashboard_controller_exists()
    {
        $this->assertTrue(class_exists('\App\\Http\\Controllers\\Admin\\DashboardController'));
    }
}
