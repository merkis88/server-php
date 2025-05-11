<?php

namespace Controller;

use Model\Reader;
use Src\View;
use Src\Request;
use Model\Issued;
use Src\Validator\ValidationManager;
use Validators\RequireValidator;
use Validators\OnlyLettersValidator;
use Validators\OnlyDigitsValidator;


class ReaderController
{
    public function new_reader(Request $request): string
    {
        $message = '';

        if ($request->method === 'POST') {
            $data = $request->all();

            $validator = new ValidationManager();
            $isValid = $validator->validate($data, [
                'lastName' => [RequireValidator::class, OnlyLettersValidator::class],
                'firstName' => [RequireValidator::class, OnlyLettersValidator::class],
                'phone' => [OnlyDigitsValidator::class]
            ]);

            if (!$isValid) {
                return new View('site.new_reader', ['errors' => $validator->errors()]);
            }

            // Если валидация прошла — сохранить пользователя
            Reader::create($data);
            app()->route->redirect('/show_reader');
        }

        return new View('site.new_reader');
    }

    public function readers($id, Request $request): string
    {
        $reader = Reader::find($id);

        if (!$reader) {
            return "Читатель не найден";
        }

        $issuedBooks = Issued::where('readerID', $id)
            ->where('isReturned', 0)
            ->with('book')
            ->get();

        return (string) new View('site.reader', [
            'reader' => $reader,
            'issuedBooks' => $issuedBooks
        ]);

    }

    public function show_reader( Request $request): string
    {
        $readers = Reader::all();
        return new View('site.show_reader', ['readers' => $readers]);
    }

    public function issued(Request $request): string
    {
        $message = '';

        if ($request->method === 'POST') {
            $readerID = (int)$request->get('readerID');
            $bookID = (int)$request->get('bookID');
            $action = $request->get('action');

            if ($action === 'issue') {
                Issued::create([
                    'readerID' => $readerID,
                    'bookID' => $bookID,
                    'issuedDate' => date('Y-m-d H:i:s'),
                    'isReturned' => 0
                ]);
                $message = 'Книга выдана.';
            }

            if ($action === 'return') {
                $entry = Issued::where('readerID', $readerID)
                    ->where('bookID', $bookID)
                    ->where('isReturned', 0)
                    ->first();

                if ($entry) {
                    $entry->update([
                        'returnDate' => date('Y-m-d H:i:s'),
                        'isReturned' => 1
                    ]);
                    $message = 'Книга возвращена.';
                } else {
                    $message = 'Выдача не найдена.';
                }
            }
        }

        return new View('site.issued', ['message' => $message]);
    }
}
