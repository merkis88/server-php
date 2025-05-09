<?php $showLayout = false; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Читатели</title>
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
            <li><a href="/issued"><img src="/assets/Unread.svg" alt=""><span>Учёт выдачи</span></a></li>
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
        <h1>Читатели</h1>
        <div class="table">
            <table>
                <thead>
                <tr>
                    <th>№</th>
                    <th>Фамилия</th>
                    <th>Имя</th>
                    <th>Отчество</th>
                    <th>Телефон</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($readers as $reader): ?>
                    <tr>
                        <td><?= $reader->id ?></td>
                        <td><a href="/reader/<?= $reader->id ?>" class="book-row"><?= htmlspecialchars($reader->lastName) ?></a></td>
                        <td><?= htmlspecialchars($reader->firstName) ?></td>
                        <td><?= htmlspecialchars($reader->patronymic) ?></td>
                        <td><?= htmlspecialchars($reader->phone) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
