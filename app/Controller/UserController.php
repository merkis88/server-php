<?php

namespace Controller;

use Model\User;
use Src\Request;
use Src\View;

class UserController
{
    public function createLibrarian(Request $request): string
    {
        if (!app()->auth::check() || app()->auth->user()->roleID !== 1) {
            return 'Доступ запрещён';
        }

        if ($request->method === 'POST') {
            $data = $request->all();
            $data['password'] = md5($data['password']);
            $data['roleID'] = 2;
            \Model\User::create($data);
            app()->route->redirect('/new_librarian');
        }

        $librarians = \Model\User::where('roleID', 2)->get();

        return new View('site.new_librarian', ['librarians' => $librarians]);
    }

    public function deleteLibrarian(Request $request): void
    {
        if (app()->auth::check() && app()->auth->user()->roleID === 1) {
            User::where('id', $request->input('id'))
                ->where('roleID', 2) // удаляем только библиотекарей
                ->delete();
        }

        app()->route->redirect('/new_librarian');
    }



    public function listLibrarians(): string
    {
        if (!app()->auth::check() || app()->auth->user()->roleID !== 1) {
            return 'Доступ запрещён';
        }

        $librarians = User::where('roleID', 2)->get();
        return (string) new View('site.librarians', ['librarians' => $librarians]);
    }
}
