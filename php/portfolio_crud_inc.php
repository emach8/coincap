<?php

session_start();

if (isset($_POST["addNewCoin"])) {

    $coin = $_POST["coin"];
    $holdings = $_POST["holdings"];
    $id = $_SESSION["userId"];

    require_once 'db.php';

    if (coinExists($conn, $id, $coin) == false) {
        insertCoin($conn, $id, $coin, $holdings);
    } else {
        header("location: ../portfolio.php?error=coinexists");
        exit();
    }
}

if (isset($_GET["userId"])) {

    $id = $_GET["userId"];
    $coin = $_GET["coin"];

    require_once 'db.php';

    $sql = "DELETE FROM coins WHERE userId=? AND coinName=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location:  ../portfolio.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $id, $coin);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location:  ../portfolio.php?message=coindeleted");
}

function coinExists($conn, $id, $coin)
{
    $sql = "SELECT * FROM coins WHERE userId = ? AND coinName = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location:  ../portfolio.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $id, $coin);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }
}

function insertCoin($conn, $id, $coin, $holdings)
{
    $sql = "INSERT INTO coins (userId, coinName, coinHoldings) VALUES (?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location:  ../portfolio.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sss", $id, $coin, $holdings);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location:  ../portfolio.php?message=coinadded");
}

if (isset($_POST["updateCoin"])) {

    $coin = $_POST["coin"];
    $holdings = $_POST["holdings"];
    $id = $_SESSION["userId"];

    require_once 'db.php';

    $sql = "UPDATE coins SET coinHoldings=? WHERE userId=? AND coinName=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location:  ../portfolio.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sss", $holdings, $id, $coin);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location:  ../portfolio.php?message=coinupdated");
}
