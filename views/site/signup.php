<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
    <link rel="stylesheet" href="/css/register.css">
</head>
<body>

<div class="register-container">
    <h2>Регистрация нового пользователя</h2>
    <h3><?= $message ?? ''; ?></h3>
    <form method="post">
        <label>Имя
            <input type="text" name="name">
        </label>
        <label>Логин
            <input type="text" name="login">
        </label>
        <label>Пароль
            <input type="password" name="password">
        </label>
        <button type="submit">Зарегистрироваться</button>
    </form>
</div>

</body>
</html>