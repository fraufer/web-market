<?php
require 'db.php';

if(isset($_SESSION['logged_user']['status'])){
    header('Location: market.php');
}

if(isset($_POST['auth'])){
    $sql = "SELECT * FROM users WHERE login=:login";
    $stmt = $pdo->prepare($sql);

    $stmt->execute([":login" => $_POST['login']]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($_POST['password'] == $user['password'])  {
        $_SESSION['logged_user'] = [
            'user_id' => $user['id'],
            'status' => TRUE
        ];
        header('Location: market.php');
    } else {
        echo "Ошибка. Неверный пароль или почта";
    }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
    <header>
        <div class="container">
            <p class="header-title">Интернет-магазин</p>
            <div class="header-links">
                <a style='text-decoration: underline;' href="market.php" class="header-links-a">Главная страница</a>
                <a href="cart.php" class="header-links-a">Корзина</a>
            </div>
            <div class="header-avatar">
                <form action="" method="post">
                    <button class="profile" name="profile">
                        
                    </button>
                </form>
                
            </div>
        </div>
    </header>
    <main>
        <div class="main-container">
            <p class="auth-title">Авторизация</p>
            <form action="" method="post" class="auth-form">
                <input type="text" name="login" placeholder="Введите логин" class="auth-input">
                <br>
                <input type="text" name="password" placeholder="Введите пароль" class="auth-input">
                <br>
                <button type="submit" name="auth" class="auth-btn">Войти</button>
            </form>
            <p class="auth-reg"><a href="register.php">Нету аккаунта? Создать</a></p>
        </div>
    </main>
    <footer>
        <div class="footer-container">
            <div class="footer-block">
                <h3>Магазин</h3>
                <a href="#">О нас</a>
                <a href="#">Доставка и оплата</a>
                <a href="#">Возврат</a>
                <a href="#">Политика конфиденциальности</a>
            </div>

            <div class="footer-block">
                <h3>Контакты</h3>
                <p>Эл. почта : shop@mail.com</p>
                <p>Телефон : +7 (777) 777-77-77</p>
            </div>

            <div class="footer-block">
                <p>&copy 2026 MyShop</p>
            </div>
        </div>
    </footer>
</body>
</html>