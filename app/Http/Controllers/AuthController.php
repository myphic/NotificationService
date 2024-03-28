<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class AuthController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth:api', except: ['login', 'register']),
        ];
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Авторизация не пройдена'], 400);
        }

        return $this->createNewToken($token);
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create(
            array_merge(
                $request->toArray(),
                ['password' => bcrypt($request->password)]
            )
        );

        return response()->json([
            'message' => 'Пользователь зарегистрирован.',
            'user' => $user,
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