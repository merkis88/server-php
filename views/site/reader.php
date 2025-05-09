<?php $showLayout = false; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($reader->lastName . ' ' . $reader->firstName) ?></title>
    <link rel="stylesheet" href="/css/hello.css">
</head>
<body>
<div class="wrapper">
    <div class="sidebar">
        <div class="logo">
            <img src="/assets/Notebook Bookmark.svg" alt="Library logo">
            <span>LIBRARY</span>
        </div>
        <ul class="menu">
            <li><a href="/hello"><img src="/assets/Widget.svg" alt=""><span>Книги</span></a></li>
            <li><a href="#"><img src="/assets/Chart 2.svg" alt=""><span>Популярные</span></a></li>
            <li><a href="/show_reader"><img src="/assets/User Id.svg" alt=""><span>Читатели</span></a></li>
            <li><a href="#"><img src="/assets/Unread.svg" alt=""><span>Учёт выдачи</span></a></li>
            <li><a href="/new_reader"><img src="/assets/User Plus Rounded.svg" alt=""><span>Новые читатели</span></a></li>
            <li><a href="/new_books"><img src="/assets/Vector.svg" alt=""><span>Новые книги</span></a></li>
        </ul>


        <div class="auth-block">
            <?php if (!app()->auth::check()): ?>
                <a href="/login" class="auth-link">Вход</a>
                <a href="/signup" class="auth-link">Регистрация</a>
            <?php else: ?>
                <p class="auth-user"><?= app()->auth->user()->name ?></p>
                <a href="/logout" class="auth-link">Выход</a>
            <?php endif; ?>
        </div>
    </div>
    <div class="main">
        <h1><?= htmlspecialchars($reader->lastName . ' ' . $reader->firstName) ?></h1>
        <p><strong>Имя:</strong> <?= htmlspecialchars($reader->firstName) ?></p>
        <p><strong>Фамилия:</strong> <?= htmlspecialchars($reader->lastName) ?></p>
        <p><strong>Отчество:</strong> <?= htmlspecialchars($reader->patronymic) ?></p>
        <p><strong>Адрес:</strong> <?= htmlspecialchars($reader->address) ?></p>
        <p><strong>Телефон:</strong> <?= htmlspecialchars($reader->phone) ?></p>
        <p><strong>Номер карточки:</strong> <?= $reader->id ?></p>
    </div>
</div>
</body>
</html>
