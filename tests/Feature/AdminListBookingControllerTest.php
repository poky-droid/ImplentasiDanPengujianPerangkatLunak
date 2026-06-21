<?php

namespace Tests\Feature;

use Tests\TestCase;

class AdminListBookingControllerTest extends TestCase
{
    public function test_admin_list_booking_controller_exists()
    {
        $this->assertTrue(class_exists('\App\\Http\\Controllers\\Admin\\List_BookingController'));
    }
}
