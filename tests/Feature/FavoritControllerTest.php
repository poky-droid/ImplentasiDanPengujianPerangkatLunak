<?php

namespace Tests\Feature;

use Tests\TestCase;

class FavoritControllerTest extends TestCase
{
    public function test_favorit_controller_exists()
    {
        $this->assertTrue(class_exists('\App\\Http\\Controllers\\FavoritController'));
    }
}
