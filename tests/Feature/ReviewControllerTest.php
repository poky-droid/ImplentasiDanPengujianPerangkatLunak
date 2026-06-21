<?php

namespace Tests\Feature;

use Tests\TestCase;

class ReviewControllerTest extends TestCase
{
    public function test_review_controller_exists()
    {
        $this->assertTrue(class_exists('\App\\Http\\Controllers\\ReviewController'));
    }
}
