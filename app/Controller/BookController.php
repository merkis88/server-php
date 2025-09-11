<?php

namespace Controller;

use Model\Book;
use Src\View;
use Src\Request;
use Validators\RequireValidator;
use Validator\OnlyDigitsValidator;
use Validator\OnlyLettersValidator;
use Src\Validator\ValidationManager;


class BookController
{
    public function new_books(Request $request): string
    {
        $message = '';

        if ($request->method === 'POST') {
            $data = $request->all();

            $validator = new ValidationManager();
            $isValid = $validator->validate($data, [
                'title' => [RequireValidator::class, OnlyLettersValidator::class],
                'author' => [RequireValidator::class, OnlyLettersValidator::class],
                'year' => [RequireValidator::class, OnlyDigitsValidator::class],
                'price' => [RequireValidator::class, OnlyDigitsValidator::class],
                'isbn' => [RequireValidator::class, OnlyDigitsValidator::class],
                'description' => [RequireValidator::class],
            ]);

            if (!$isValid) {
                return (string)new View('site.new_books', [
                    'errors' => $validator->errors(),
                    'message' => 'Ошибка валидации'
                ]);
            }

            // Обработка загрузки файла
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $file = $_FILES['image'];
                $filename = time() . '_' . basename($file['name']);
                $destination = __DIR__ . '/../../public/uploads/' . $filename;

                if (move_uploaded_file($file['tmp_name'], $destination)) {
                    $data['image'] = $filename;
                    $message = 'Файл успешно загружен. ';
                } else {
                    $message = 'Ошибка при загрузке обложки. ';
                }
            }

            if (Book::create($data)) {
                $message .= 'Книга успешно добавлена.';
            } else {
                $message .= 'Ошибка при добавлении книги.';
            }
        }
        return new View('site.new_books', ['message' => $message]);
    }

    public function show_book($id, Request $request): string
    {
        $book = Book::find($id);

        if (!$book) {
            return "Книга не найдена";
        }
        return new View('site.show_book', ['book' => $book]);
    }

}