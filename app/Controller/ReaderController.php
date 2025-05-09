<?php

namespace Controller;

use Model\Reader;
use Src\View;
use Src\Request;

class ReaderController
{
    public function new_reader(Request $request): string
    {
        if ($request->method === 'POST') {
            Reader::create($request->all());
            app()->route->redirect('/readers');
        }

        return new View('site.new_reader');
    }

    public function readers($id, Request $request): string
    {
        $reader = Reader::find($id);

        if (!$reader) {
            return "Читатель не найден";
        }

        return new View('site.reader', ['reader' => $reader]);

    }

    public function show_reader( Request $request): string
    {
        $readers = Reader::all();
        return new View('site.show_reader', ['readers' => $readers]);


    }
}
