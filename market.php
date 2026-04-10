<?php
require 'db.php';

$sort = $_GET['sort'] ?? "";

$order = "ORDER BY id ASC";

if($sort == "price_asc"){
    $order = "ORDER BY price ASC";
} elseif($sort == "price_desc"){
    $order = "ORDER BY price DESC";
} elseif($sort == "name_asc"){
    $order = "ORDER BY name ASC";
}

$sql = "SELECT * FROM products $order";
echo $sql;
$stmt = $pdo->query($sql);

if(isset($_POST['buy'])){
    $id = $_POST['buy'];    
    $request = $pdo->query("SELECT * FROM products WHERE id = $id");
    $item = $request->fetch(PDO::FETCH_ASSOC);
    $name = $item['name'];
    $description = $item['description'];
    $price = $item['price'];
    $image = $item['image'];
    
    $pdo_request = "INSERT INTO cart (id, name, description, price, image) VALUES ('$id', '$name', '$description', '$price', '$image')";

    if($pdo->query($pdo_request) === TRUE) {
        echo "<script>alert('Товар добавлен в корзину!')</script>";
    } else {
        
    }
}

if(isset($_GET['search'])){
    $search = $_GET['search'];

    $sql = "SELECT * FROM products WHERE name LIKE ?";
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
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <form action="" method="post" class="header-form">
        <header>
            <div class="container">
                <p class="header-title">Интернет-магазин</p>
                <div class="header-links">
                    <a style='text-decoration: underline;' href="market.php" class="header-links-a">Главная страница</a>
                    <a href="cart.php" class="header-links-a">Корзина</a>
                </div>
                <div class="header-avatar">
                    <button class="profile" name="profile">
                        
                    </button>
                    
                </div>
            </div>
        </header>
    </form>
    <main>
        <div class="main-container">
            <form action="" method="get">
                <div class="search">
                    <input type="text" name="search" class="search-input" placeholder="Поиск...">
                    <button type="submit" class="search-btn">Найти</button>
                </div>
                <div class="sort">
                    <select name="sort">
                        <option value="price_asc">Сначало дешёвые</option>
                        <option value="price_desс">Сначало дорогие</option>
                        <option value="name_asc">По названию (A-Z)</option>
                        <input type="submit">
                    </select>
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
                                <h3 class='item-price'>" . $row['price'] . " тг </h3>
                                <button class='item-button' name='buy' value='" . $row['id'] . "'>Купить</button>
                            </div>
                        </a>
                        ";
                    }
                    ?>
                </div>
            </form>
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

