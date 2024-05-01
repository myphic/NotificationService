<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\UserService;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class AuthController extends Controller implements HasMiddleware
{
    public function __construct(private readonly UserService $service)
    {
    }

    public static function middleware(): array
    {
        return [
            new Middleware('auth:api', except: ['login', 'register']),
        ];
    }

    public function login(LoginRequest $request)
    {
        $token = $this->service->login($request->toArray());

        if (!$token) {
            return response()->json(['error' => 'Авторизация не пройдена'], 400);
        }

        return $this->createNewToken($token);
    }

    public function register(RegisterRequest $request)
    {
        return response()->json([
            'message' => 'Пользователь зарегистрирован.',
            'user' => $this->service->register($request->toArray()),
        ], 201);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Успешный разлогин.']);
    }

    public function refresh()
    {
        return $this->createNewToken(auth()->refresh());
    }

    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user(),
        ]);
    }
}
