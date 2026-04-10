<?php
require 'db.php';

$stmt = $pdo->query("SELECT * FROM cart");

if(isset($_POST['delete'])){
    $id = $_POST['delete'];
    $pdo->query("DELETE FROM cart WHERE id = " . $id);
    echo "<script>alert('Товар удален из корзину!')</script>";
}

if(isset($_GET['search'])){
    $search = $_GET['search'];

    $sql = "SELECT * FROM cart WHERE name LIKE ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["%$search%"]);

}

if(isset($_POST['profile'])){
    if(isset($_SESSION['logged_user'])){
        header('Location: profile.php');
    } else{
        header('Location: auth.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Интернет-мазагин</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="" method="post" class="header-form">
        <header>
            <div class="container">
                <p class="header-title">Интернет-магазин</p>
                <div class="header-links">
                    <a href="market.php" class="header-links-a">Главная страница</a>
                    <a style='text-decoration: underline;' href="cart.php" class="header-links-a">Корзина</a>
                </div>
                <div class="header-avatar">
                    <button class="profile" name="profile">
                        
                    </button>
                    
                </div>
            </div>
        </header>
    </form>
    <form action="" method="post">
        <main>
            <div class="main-container">
                <form action="" method="get">
                    <div class="search">
                        <input type="text" name="search" class="search-input" placeholder="Поиск...">
                        <button type="submit" class="search-btn">Найти</button>
                    </div>
                </form>
                <form action="" method="post">
                    <div class="items">
                        <?php
                        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                            echo
                            "
                            <a class='item-a' href='item_card.php?id=" . $row['id'] . "'>
                                <div class='item'>
                                    <p><img class='item-img' src=" . $row['image'] . " ></p>
                                    <h3 class='item-title'>" . $row['name'] . " </h3>
                                    <h3 class='item-price'>" . $row['price'] . " </h3>
                                    <button class='item-button' style='background-color: red;' name='delete' value='" . $row['id'] . "'>Удалить</button>
                                </div>
                            </a>
                            ";
                        }
                        ?>
                    </div>
                </form>
            </div>
        </main>
    </form>
    <footer>
        <div class="footer-container">
            <div class="footer-block">
                <h3>Магазин</h3>
                <a href="">О нас</a>
                <a href="">Доставка и оплата</a>
                <a href="">Возврат</a>
                <a href="">Политика конфиденциальности</a>
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

