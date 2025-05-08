<?php $showLayout = false; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Книги</title>
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
            <li><a href="#"><img src="/assets/User Id.svg" alt=""><span>Читатели</span></a></li>
            <li><a href="#"><img src="/assets/Unread.svg" alt=""><span>Учёт выдачи</span></a></li>
            <li><a href="#"><img src="/assets/User Plus Rounded.svg" alt=""><span>Новые читатели</span></a></li>
            <li><a href="#"><img src="/assets/Vector.svg" alt=""><span>Новые книги</span></a></li>
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
        <h1>Книги</h1>
        <div class="table">
            <table>
                <thead>
                <tr>
                    <th>Название</th>
                    <th>Автор</th>
                    <th>Год издания</th>
                    <th>Статус</th>
                </tr>
                </thead>
                <tbody>
                <?php if (!empty($books)): ?>
                    <?php foreach ($books as $book): ?>
                        <tr>
                            <td><a href="/book/<?= $book->id ?>" class="book-row"><?= htmlspecialchars($book->title) ?></a></td>
                            <td><?= htmlspecialchars($book->author) ?></td>
                            <td><?= htmlspecialchars($book->year) ?></td>
                            <td><?= ($book->status ?? '—') ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td><a href="#" class="book-row">—</a></td>
                        <td>—</td>
                        <td>—</td>
                        <td>—</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
