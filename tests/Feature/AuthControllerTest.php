<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthControllerTest extends TestCase
{
    public function test_login_returns_true_when_credentials_are_correct()
    {
        $email = 'user@example.com';
        $password = 'secret';

        Auth::shouldReceive('attempt')
            ->once()
            ->with(['email' => $email, 'password' => $password])
            ->andReturn(true);

        $controller = new AuthController();
        $request = Request::create('/login', 'POST', ['email' => $email, 'password' => $password]);

        $result = $controller->login($request);

        $this->assertTrue($result);
    }

    public function test_login_returns_false_when_credentials_are_incorrect()
    {
        $email = 'user2@example.com';
        $password = 'wrong';

        Auth::shouldReceive('attempt')
            ->once()
            ->with(['email' => $email, 'password' => $password])
            ->andReturn(false);

        $controller = new AuthController();
        $request = Request::create('/login', 'POST', ['email' => $email, 'password' => $password]);

        $result = $controller->login($request);

        $this->assertFalse($result);
    }
}
