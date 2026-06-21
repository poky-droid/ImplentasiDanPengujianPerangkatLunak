<?php

namespace Tests\Feature;

use Tests\TestCase;

class ControllersExistTest extends TestCase
{
    public function test_all_controllers_exist()
    {
        $controllers = [
            // top-level controllers
            'App\\Http\\Controllers\\BookingController',
            'App\\Http\\Controllers\\KosController',
            'App\\Http\\Controllers\\NotifikasiController',
            'App\\Http\\Controllers\\ChatController',
            'App\\Http\\Controllers\\ProfileController',
            'App\\Http\\Controllers\\AuthController',
            'App\\Http\\Controllers\\ReviewController',
            'App\\Http\\Controllers\\FavoritController',
            'App\\Http\\Controllers\\HomeController',
            // Admin namespace
            'App\\Http\\Controllers\\Admin\\OwnerController',
            'App\\Http\\Controllers\\Admin\\KomplainController',
            'App\\Http\\Controllers\\Admin\\PengajuanMitraController',
            'App\\Http\\Controllers\\Admin\\List_BookingController',
            'App\\Http\\Controllers\\Admin\\DashboardController',
            'App\\Http\\Controllers\\Admin\\PembayaranController',
            'App\\Http\\Controllers\\Admin\\UserController',
            // Auth namespace
            'App\\Http\\Controllers\\Auth\\RegisterController',
            'App\\Http\\Controllers\\Auth\\LoginController',
            // Owner namespace
            'App\\Http\\Controllers\\Owner\\PembayaranController',
            'App\\Http\\Controllers\\Owner\\KosController',
            'App\\Http\\Controllers\\Owner\\NotificationController',
            'App\\Http\\Controllers\\Owner\\BookingController',
        ];

        foreach ($controllers as $class) {
            $this->assertTrue(class_exists($class), "Controller class {$class} should exist");
        }
    }
}
