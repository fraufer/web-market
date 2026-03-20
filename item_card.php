<?php
require 'db.php';

if(isset($_POST['buy'])){
    $id = $_POST['buy'];    
    $request = $conn->query("SELECT * FROM products WHERE id = $id");
    $item = $request->fetch_assoc();
    $name = $item['name'];
    $description = $item['description'];
    $price = $item['price'];
    $image = $item['image'];

    
    $sql = "INSERT INTO cart (id, name, description, price, image) VALUES ('$id', '$name', '$description', '$price', '$image')";

    if($conn->query($sql) === TRUE) {
        echo "<script>alert('Товар добавлен в корзину!')</script>";
    } else {
        echo "Ошибка. Товар уже добавлне в корзину";
    }
}

$id = $_GET['id'];
$sql = "SELECT * FROM products WHERE id = $id";
$result = $conn->query($sql);

$item = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Интернет-мазагин</title>
    <link rel="stylesheet" href="item_card.css">
</head>
<body>
    <form action="" method="post" class="header-form">
        <header>
            <div class="container">
                <p class="header-title">Интернет-магазин</p>
                <div class="header-links">
                    <a href="market.php" class="header-links-main">Главная страница</a>
                    <a href="cart.php" class="header-links-cart">Корзина</a>
                </div>
            </div>
        </header>
    </form>
    <form action="" method="post">
        <main>
            <div class="container">
                <?php
                    echo
                    "
                    <a class='item-a' href='item_card.php?id=" . $item['id'] . "'>
                        <div class='item-card'>
                            <p><img class='item-img' src=" . $item['image'] . " ></p>
                            <h3 class='item-title'>" . $item['name'] . " </h3>
                            <p class='item-description'>" . $item['description'] ."</p>
                            <h3 class='item-price'>" . $item['price'] . " </h3>
                            <button class='item-button' name='buy' value='" . $item['id'] . "'>Купить</button>
                        </div>
                    </a>
                    ";
                ?>
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

