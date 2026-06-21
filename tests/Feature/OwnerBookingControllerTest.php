<?php

namespace Tests\Feature;

use Tests\TestCase;

class OwnerBookingControllerTest extends TestCase
{
    public function test_owner_booking_controller_exists()
    {
        $this->assertTrue(class_exists('\App\\Http\\Controllers\\Owner\\BookingController'));
    }
}
