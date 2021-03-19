<?php
session_start();
include "func_flash.php";
require "db_config.php";
$connect = mysqli_connect($hostname, $db_username, $db_password, $db_name);
if (isset($_SESSION["id"])) {

    header("location:index.php");
}


if (isset($_POST["register"])) {
    if (empty($_POST["user_name"]) || empty($_POST["user_email"]) || empty($_POST["user_password"])) {
        setFlash("error","All fields are required");
        header("location:register.php");
    } else {
        $user_name = mysqli_real_escape_string($connect, $_POST["user_name"]);
        $user_email = $_POST["user_email"];
        if(!filter_var($user_email,FILTER_VALIDATE_EMAIL)){
            setFlash("error","Invalid email format");
        }
        $user_password =  $_POST["user_password"];
        $user_password = md5($user_password);
        $query = "SELECT email FROM users where email='$user_email'";
        $duplicate = mysqli_query($connect, $query);
        var_dump($duplicate);
        if (mysqli_num_rows($duplicate) > 0) {
            setFlash("error","That email is already in use");
            header("location:register.php");
        } else {
            $query = "INSERT INTO users (name,email,pass ) VALUES('$user_name','$user_email','$user_password') ";
            if (mysqli_query($connect, $query)) {
                header("location:register.php?action=login");
            }
        }
    }
}
if (isset($_POST["login"])) {
    if (empty($_POST["user_email"]) || empty($_POST["user_password"])) {
        setFlash("error","All fields are required");
        header("location:register.php?action=login");
    } else {

        $user_email =  $_POST["user_email"];
        $user_password =  $_POST["user_password"];
        $user_password = md5($user_password);
        $query = "SELECT id ,name FROM users WHERE email = '$user_email' AND pass ='$user_password'";
        $result = mysqli_query($connect, $query);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            var_dump($row);
            $_SESSION['id'] = $row['id'];
            $_SESSION['name'] = $row['name'];
            header("location:index.php");
        } else {
            setFlash("error","Wrong Email or Password");
            header("location:register.php?action=login");
        }
    }
}
