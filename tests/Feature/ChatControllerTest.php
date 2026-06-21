<?php

namespace Tests\Feature;

use Tests\TestCase;

class ChatControllerTest extends TestCase
{
    public function test_chat_controller_exists()
    {
        $this->assertTrue(class_exists('\App\\Http\\Controllers\\ChatController'));
    }
}
