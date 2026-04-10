<?php
require 'db.php';

if(isset($_SESSION['logged_user'])){
    $user_id = $_SESSION['logged_user']["user_id"];

    $sql = "SELECT * FROM users WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([":id" => $user_id]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);
}

if(isset($_POST['leave'])){
    $_SESSION['logged_user'] = null;
    header('Location: market.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>   
        .container{
            max-width: 1500px;
            margin: 0 auto;
            padding: 0 auto;
            box-sizing: border-box;
        }
        .pfp{
            width: 200px; 
            height: 200px; 
            border: 2px solid; 
            border-radius: 90px; 
            align-items: center;
        }
        p{
            font-size: 30px;
        }
        button{
            width: 300px;
            height: 100px;
            font-size: 30px;
            border-radius: 10px;
        }
        *{
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
            margin: auto 0;
            padding: auto 0;
        }
        a{
            text-decoration: none;
            color: black;
        }
        .container{
            max-width: 1500px;
            margin: 0 auto;
            padding: 0 auto;
            box-sizing: border-box;
            display: flex;
        }
        header{
            padding: 20px;
            border-bottom: 1px solid black;
        }
        .header-title{
            font-size: 32px;
        }
        .header-links{
            margin-left: 681px;
            font-size: 26px;
        }
        .header-links-a{
            margin-left: 50px;
            transition: 0.1s;
        }
        .header-links-a:hover{
            transform: scale(2);
        }
        .profile{
            margin-left: 50px;
            width: 75px;
            height: 75px;
            background: url('img/avatar.webp') center/cover no-repeat;
            border: 2px solid black;
            cursor: pointer;
            border-radius: 90px;
        }
    </style>
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
                <button class="profile" name="profile">
                    
                </button>
                
            </div>
        </div>
    </header>
    <main>
        <div class="container">
            <div class="avatar">
                <img src="img/avatar.webp" alt="" class="pfp">
            </div>
            <div class="user-data">
                <p>Имя пользователя : <?php echo $user['login']?></p>
                <p>Эл. почта : <?php echo $user['email']?></p>
                <form action="" method="post">
                    <button name="leave">Выйти из аккаунта</button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>