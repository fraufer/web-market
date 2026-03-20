<?php
require 'db.php';

if(isset($_POST['delete'])){
    $id = $_POST['delete'];
    $conn->query("DELETE FROM cart WHERE id = " . $id);
    echo "<script>alert('Товар удален из корзину!')</script>";
}



$result = $conn->query("SELECT * FROM cart");
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
            </div>
        </header>
    </form>
    <form action="" method="post">
        <main>
            <div class="container">
                <div class="items">
                    <form action="" method="post">
                        <?php
                        while($row = $result->fetch_assoc()){
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
                    </form>
                </div>
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
                <p>C 2026 MyShop</p>
            </div>
        </div>
    </footer>
</body>
</html>

