<?php

namespace Tests\Feature;

use Tests\TestCase;

class BookingControllerTest extends TestCase
{
    public function test_booking_controller_exists()
    {
        $this->assertTrue(class_exists('\App\\Http\\Controllers\\BookingController'));
    }
}
