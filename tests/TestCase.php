<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

// Use local CreatesApplication trait (tests/CreatesApplication.php)
abstract class TestCase extends BaseTestCase
{
    use \Tests\CreatesApplication;
}
