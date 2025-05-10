<?php

namespace Controller;

use Model\Post;
use Model\User;
use Src\View;
use Src\Request;
use Src\Auth\Auth;
use Model\Book;

class Site
{
    public function index(Request $request): string
    {
        $posts = Post::where('id', $request->id)->get();
        return (new View())->render('site.post', ['posts' => $posts]);
    }

    public function hello(): string
    {
        $books = Book::all();
        return new View('site.hello', ['books' => $books]);
    }

    public function signup(Request $request): string
    {
        $message = '';
        if ($request->method === 'POST') {
            $data = $request->all();
            $data['password'] = md5($data['password']);
            $data['roleID'] = 2; // по умолчанию библиотекарь

            \Model\User::create($data);
            app()->route->redirect('/login');
        }

        return (string) new \Src\View('site.signup', ['message' => $message]);
    }



    public function login(Request $request): string
    {
        //Если просто обращение к странице, то отобразить форму
        if ($request->method === 'GET') {
            return new View('site.login');
        }
        //Если удалось аутентифицировать пользователя, то редирект
        if (Auth::attempt($request->all())) {
            app()->route->redirect('/hello');
        }
        //Если аутентификация не удалась, то сообщение об ошибке
        return new View('site.login', ['message' => 'Неправильные логин или пароль']);
    }

    public function logout(): void
    {
        Auth::logout();
        app()->route->redirect('/hello');
    }
}