<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

    if (isset($_REQUEST['enter'])) {
        $userLogin = $_REQUEST['login'];
        $userPassword = $_REQUEST['password'];
        if ($userLogin == 'admin' && $userPassword == '123') {
            $_SESSION["userLogin"] = $userLogin;
            header("Location: index.php");
            exit();
        }
        else {
            
            echo "Invalid login or password for an admin user";
        }
    }

?>