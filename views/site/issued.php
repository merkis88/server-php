<?php $showLayout = false; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Учёт выдачи</title>
    <link rel="stylesheet" href="/css/hello.css">
    <link rel="stylesheet" href="/css/new-books.css">
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
            <li><a href="/new_librarian"><img src="/assets/User Plus Rounded.svg" alt=""><span>Новые библиотекари</span></a></li>
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
        <h1>Учёт выдачи и возврата книг</h1>

        <div class="form-wrapper">
            <form method="post">
                <div class="form-row">
                    <label>Номер карточки</label>
                    <input type="number" name="readerID" required>
                </div>
                <div class="form-row">
                    <label>ФИО</label>
                    <input type="text" name="fullName" required>
                </div>
                <div class="form-row">
                    <label>Телефон</label>
                    <input type="text" name="phone" required>
                </div>
                <div class="form-row">
                    <label>Название книги</label>
                    <input type="text" name="bookTitle" required>
                </div>
                <div class="form-row">
                    <label>ID книги</label>
                    <input type="number" name="bookID" required>
                </div>
                <div class="button-wrap">
                    <button type="submit" name="action" value="issue" class="btn dark">Выдать книгу</button>
                    <button type="submit" name="action" value="return" class="btn dark">Принять книгу</button>
                </div>
            </form>

            <?php if (!empty($message)): ?>
                <p style="margin-top: 20px;"><strong><?= htmlspecialchars($message) ?></strong></p>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>
