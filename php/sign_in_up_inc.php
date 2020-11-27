<?php

if (isset($_POST["signUp"])) {

    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    require_once 'db.php';
    require_once 'db_sign_functions.php';

    if (emptyInputSignup($name, $email, $password) !== false) {
        header("location: ../sign_in.php?error=emptyinputsignup");
        exit();
    }

    if (userExists($conn, $email) !== false) {
        header("location: ../sign_in.php?error=emailexists");
        exit();
    }
    createUser($conn, $name, $email, $password);
} else if (isset($_POST["signIn"])) {

    echo 'heeey';

    $email = $_POST["email"];
    $password = $_POST["password"];

    require_once 'db.php';
    require_once 'db_sign_functions.php';

    if (emptyInputLogin($email, $password) !== false) {
        header("location: ../sign_in.php?error=emptyinputlogin");
        exit();
    }

    loginUser($conn, $email, $password);
} else {
    header("location: ../sign_in.php");
    exit();
}
