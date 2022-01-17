<?php
    $conn = mysqli_connect("localhost", "root", "", "assistent");
    
    $sql = "SELECT * FROM data";
    $query = mysqli_query($conn, $sql);

    $sqlw = "SELECT * FROM waitingdata";
    $queryw = mysqli_query($conn, $sqlw);
    if (isset($_REQUEST["new_feedback"])) {
        $username = $_REQUEST["username"];
        $email = $_REQUEST["email"];
        $message = $_REQUEST["message"];
        $images = $_FILES["f_image"]['name'];

        $targetfile = "upload/".basename($_FILES["f_image"]['name']);
        $imagefiletype = strtolower(pathinfo($targetfile, PATHINFO_EXTENSION));
        
        $checkValid = 1;
        if (strlen($username) < 4) {
            $checkValid = 0;
            $_SESSION['usernameErr'] = "Ваш логин должен содержать не менее 4 символов!";
        }
        if (strpos($email, '@') == false) {
            $checkValid = 0;
            $_SESSION['emailErr'] = "Формат почты неправильный!";
        }
        if (strlen($message) < 10) {
            $checkValid = 0;
            $_SESSION['messageErr'] = "Длина отзыва должна быть не менее 10 букв";
        }
        
        if ($_FILES["f_image"]['size'] > 1000000) {
            $checkValid = 0;
            $_SESSION['imageErr'] = "Размер вашего файла должно быть меньше 1мб";
        }

        if ($imagefiletype != "jpg" && $imagefiletype != "png" && $imagefiletype != "gif") {
            $checkValid = 0;
            $_SESSION['imageErr'] = "Формат вашего файла должен быть .jpg или .png или .gif";
        }

        if ($checkValid) {
            $sql = "INSERT INTO waitingdata(name, email, content, img) VALUES('$username', '$email', '$message', '$images')";
            mysqli_query($conn, $sql);
            $sql = "INSERT INTO accepteddata(name, email, content, img) VALUES('$username', '$email', '$message', '$images')";
            mysqli_query($conn, $sql);
            move_uploaded_file($_FILES["f_image"]["tmp_name"], "upload/".$_FILES["f_image"]["name"]);
            header("Location: index.php");
            exit();
        }
        
    }

    if (isset($_REQUEST["accept"])) {
        $id = $_REQUEST['idw'];
        $username = $_REQUEST['namew'];
        $email = $_REQUEST['emailw'];
        $message = $_REQUEST['contentw'];
        $images = $_REQUEST['f_imagew'];
        
        $sqlw = "DELETE FROM waitingdata WHERE id=$id";
        $queryw = mysqli_query($conn, $sqlw);
        
        $sql = "INSERT INTO data(name, email, content, img) VALUES('$username', '$email', '$message', '$images')";
        mysqli_query($conn, $sql);
        move_uploaded_file($_FILES["f_imagew"]["tmp_name"], "upload/".$_FILES["f_imagew"]["name"]);
        header("Location: index.php");
        exit();
        
    }

    if (isset($_REQUEST["decline"])) {
        $id = $_REQUEST['idw'];
        $sqlw = "DELETE FROM waitingdata WHERE id=$id";
        $queryw = mysqli_query($conn, $sqlw);
        header("Location: index.php");
        exit();
    }

    if (isset($_REQUEST["delete"])) {
        $id = $_REQUEST['idd'];
        $sql = "DELETE FROM data WHERE id=$id";
        $query = mysqli_query($conn, $sql);
        header("Location: index.php");
        exit();
    }

    if (isset($_REQUEST["update_btn"])) {
        $id = $_REQUEST['edit_id'];
        $message = $_REQUEST['edit_message'];
        $sql = "UPDATE data SET content='$message', updated='1' WHERE id = $id";
        $query = mysqli_query($conn, $sql); 
        header("Location: index.php");
        exit();
        
    }
    
    if (isset($_REQUEST["select"])) {

        $color = filter_input(INPUT_POST, 'sorting', FILTER_SANITIZE_STRING);
        
        if ($color == "byDate") {
            $sql = "SELECT * FROM data ORDER BY id DESC";
        }
        elseif ($color == "byName") {
            $sql = "SELECT * FROM data ORDER BY name ASC";
        }
        elseif ($color == "byEmail") {
            $sql = "SELECT * FROM data ORDER BY email ASC";
        }

        $query = mysqli_query($conn, $sql);
    }

?>