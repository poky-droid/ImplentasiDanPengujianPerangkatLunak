<?php

namespace Tests\Feature;

use Tests\TestCase;

class OwnerNotificationControllerTest extends TestCase
{
    public function test_owner_notification_controller_exists()
    {
        $this->assertTrue(class_exists('\App\\Http\\Controllers\\Owner\\NotificationController'));
    }
}
