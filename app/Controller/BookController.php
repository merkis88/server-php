<?php

namespace Controller;

use Model\Book;
use Src\View;
use Src\Request;

class BookController
{
    public function new_books(Request $request): string
    {
        if ($request->method === 'POST') {
            Book::create($request->all());
            app()->route->redirect('/hello');
        }
        return new View('site.new_books');
    }
}