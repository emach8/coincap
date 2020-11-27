<?php

function emptyInputSignup($name, $email, $password)
{
    if (empty($name) || empty($email) || empty($password)) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

function emptyInputLogin($email, $password)
{
    if (empty($email) || empty($password)) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

function userExists($conn, $email)
{
    $sql = "SELECT * FROM users WHERE userEmail = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location:  ../sign_in.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }
}

function createUser($conn, $name, $email, $password)
{
    $sql = "INSERT INTO users (userName, userEmail, userPasswd) VALUES (?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location:  ../sign_in.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sss", $name, $email, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location:  ../sign_in.php?message=usercreated");
}

function loginUser($conn, $email, $password)
{
    $userExists = userExists($conn, $email);

    if ($userExists === false) {
        header("location: ../sign_in.php?error=userdoesnotexist");
        exit();
    }

    $pwdHashed = $userExists["userPasswd"];
    $checkPwd = password_verify($password, $pwdHashed);

    if ($checkPwd === false) {
        header("location: ../sign_in.php?error=wrongpassword");
        exit();
    } else if ($checkPwd === true) {
        session_start();
        $_SESSION["userId"] = $userExists["userId"];
        $_SESSION["userEmail"] = $userExists["userEmail"];
        $_SESSION["userName"] = $userExists["userName"];

        header("location: ../index.php");
    }
}
