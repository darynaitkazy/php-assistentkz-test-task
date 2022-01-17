<?php 
    session_start();
    include 'logic.php';
    include 'logicForLogin.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <form method="post" enctype="multipart/form-data">
            <input type="text" name="username" placeholder="Введите имя" class="form-control bg-dark text-white my-3 text-center">
            <?php
                if (isset($_SESSION['usernameErr'])) { ?>
                    <p style="color: red;">* <?php echo $_SESSION['usernameErr']; unset($_SESSION['usernameErr']); ?> </p> 
            <?php
                }
            ?>
            <input type="text" name="email" placeholder="Введите email" class="form-control bg-dark text-white my-3 text-center">
            <?php
                if (isset($_SESSION['emailErr'])) { ?>
                    <p style="color: red;">* <?php echo $_SESSION['emailErr']; unset($_SESSION['emailErr']);?> </p> 
            <?php
                }
            ?>
            <textarea name="message" class="form-control bg-dark text-white my-3"></textarea>
            <?php
                if (isset($_SESSION['messageErr'])) { ?>
                    <p style="color: red;">* <?php echo $_SESSION['messageErr']; unset($_SESSION['messageErr']); ?> </p> 
            <?php
                }
            ?>
            <input type="file" name="f_image" id="f_image" class="form-control"><br>
            <?php
                if (isset($_SESSION['imageErr'])) { ?>
                    <p style="color: red;">* <?php echo $_SESSION['imageErr']; unset($_SESSION['imageErr']);?> </p> 
            <?php
                }
            ?>
            <button name="new_feedback" class="btn btn-dark">Отправить отзыв</button>
        </form>
    </div>
</body>
</html>