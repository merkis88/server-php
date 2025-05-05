<?php

use Src\Route;

//Включаем запрет на неявное преобразование типов
declare(strict_types=1);
//Включаем сессии на все страницы
session_start();

Route::add('go', [Controller\Site::class, 'index']);
Route::add('hello', [Controller\Site::class, 'hello']);
Route::add('signup', [Controller\Site::class, 'signup']);