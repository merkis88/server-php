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
        <label>Фамилия
            <input type="text" name="lastName" required>
        </label>
        <label>Имя
            <input type="text" name="firstName" required>
        </label>
        <label>Отчество
            <input type="text" name="patronymic">
        </label>
        <label>Телефон
            <input type="text" name="phone">
        </label>
        <label>Логин
            <input type="text" name="login" required>
        </label>
        <label>Пароль
            <input type="password" name="password" required>
        </label>
        <button type="submit">Зарегистрироваться</button>
    </form>

</div>

</body>
</html>