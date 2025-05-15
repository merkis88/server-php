<?php

namespace Controller;

use Model\User;
use Src\Request;
use Src\View;
use Src\Validator\ValidationManager;
use Validators\OnlyLettersValidator;
use Validators\RequireValidator;
use Validators\PhoneValidator;

class UserController
{
    public function createLibrarian(Request $request): string
    {
        if (!app()->auth::check() || app()->auth->user()->roleID !== 1) {
            return 'Доступ запрещён';
        }

        $message = '';
        $data = $request->all();

        if ($request->method === 'POST' && isset($data['delete_id'])) {
            User::where('id', $data['delete_id'])->where('roleID', 2)->delete();
            $message = 'Библиотекарь удалён.';
        }

        if ($request->method === 'POST' && isset($data['login']) && isset($data['password'])) {

            $validator = new ValidationManager();
            $isValid = $validator->validate($data, [
                'phone' => [RequireValidator::class, PhoneValidator::class],
                'lastName' => [RequireValidator::class, OnlyLettersValidator::class],
                'firstName' => [RequireValidator::class, OnlyLettersValidator::class],
                'patronymic' =>[RequireValidator::class, OnlyLettersValidator::class],
            ]);

            if (!$isValid) {
                return new View('site.new_librarian', [
                    'librarians' => User::where('roleID', 2)->get(),
                    'message' => 'Ошибка валидации',
                    'errors' => $validator->errors()
                ]);
            }

            if (User::where('login', $data['login'])->exists()) {
                $message = 'Ошибка: логин уже существует.';
            } else {
                $data['password'] = md5($data['password']);
                $data['roleID'] = 2;
                User::create($data);
                $message = 'Библиотекарь добавлен.';
            }
        }

        $librarians = User::where('roleID', 2)->get();
        return new View('site.new_librarian', [
            'librarians' => $librarians,
            'message' => $message
        ]);
    }
}
