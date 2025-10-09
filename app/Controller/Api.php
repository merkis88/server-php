<?php

namespace Controller;

use Model\Post;
use Model\User;
use Src\Request;
use Src\View;

class Api
{
    public function index(): void
    {
        $posts = Post::all()->toArray();
        (new View())->toJSON($posts);
    }

    public function echo(Request $request): void
    {
        (new View())->toJSON($request->all());
    }

    public function login(Request $request): void
    {
        $user = (new User())->attemptIdentity([
            'login' => $request->get('login'),
            'password' => $request->get('password'),
        ]);

        if (!$user) {
            (new View())->toJSON(['error' => 'Неверный логин или пароль'], 401);
        }

        // Генерация токена
        $token = bin2hex(random_bytes(32));
        $user->api_token = $token;
        $user->save();

        (new View())->toJSON([
            'token' => $token,
            'user_id' => $user->id,
            'role' => $user->roleID
        ]);
    }
}

