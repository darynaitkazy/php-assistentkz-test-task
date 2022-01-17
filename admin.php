<?php
    include 'logicForLogin.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login for admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>
    <div class="container">
        <h1>Логин</h1>
        <form action="" method="post">
            <input type="text" name="login" placeholder="Введите логин"><br><br>
            <input type="password" name="password" placeholder="Введите пароль"><br><br>
            <button name="enter" class="btn btn-dark">Зайти</button>
        </form>
    </div>
</body>
</html>