<?php

namespace Controller;

use Model\User;
use Src\View;

class AdminSeederController
{
    public function createAdmin(): string
    {
        $exists = User::where('login', 'admin')->first();

        if ($exists) {
            return new View('site.seed', ['message' => 'Админ уже существует']);
        }

        User::create([
            'firstName' => 'Admin',
            'lastName' => 'Adminov',
            'login' => 'admin',
            'password' => md5('admin'),
            'roleID' => 1,
            'name' => 'Администратор'
        ]);

        return new View('site.seed', ['message' => 'Админ успешно создан!']);
    }
}
