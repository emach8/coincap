<?php
session_start();
require_once 'php/api_functions.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>CoinCap</title>
  <link rel="icon" href="img/favicon-32x32.png" type="image/x-icon" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.22/b-1.6.5/datatables.min.css" />
  <link rel="stylesheet" href="css/style.css" />
</head>

<body>
  <header>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark primary-color-dark fixed-top scrolling-navbar">
      <div class="container">
        <a class="navbar-brand" href="index.php">
          <i class="fab fa-bitcoin fa-2x d-inline-block align-top"></i>
          <span class="navbar-brand mb-2 h1 ml-2">CoinCap</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="news.php">News</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contact.php">Contact</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="about.php">About</a>
            </li>
          </ul>
        </div>
        <?php if (isset($_SESSION["userId"])) {
          echo '<div class="dropdown">
          <a class="btn white text-dark btn-md rounded dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            ' . $_SESSION["userName"] . '
          </a>
          <div class="dropdown-menu text-center" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item text-uppercase" href="portfolio.php">My Portfolio</a>
            <a class="dropdown-item text-uppercase text-danger" href="php/sign_out_inc.php">Sign Out</a>
          </div>
        </div>';
        } else {
          echo '<a class="btn btn-light btn-md text-dark rounded text-uppercase" href="sign_in.php" role="button">Sign In</a>';
        } ?>
      </div>
    </nav>
  </header>
  <div class="container" style="margin-top: 100px; margin-bottom: 100px">
    <div class="w-100 p-4 text-center">
      <h2 class="mb-3">About CoinCap</h2>
      <p class="lead">
        CoinCap is price-tracking website for cryptoassets in the rapidly growing cryptocurrency space. CoinCap is tracking price, volume and market capitalization
        of top 100 cryptoassets, providing support for creation custom tracking portfolios for yours favourite coins.
        CoinCap provides a fundamental analysis of the crypto market for their users, institutions and media from 2020.
      </p>
      <br>
      <p class="lead text-muted">If you have any feedback or enquiries send us an email at <a href="contact.php"><u>contact page</u></a>.</p>
      <br>
      <p class="h4 text-center">CoinCap sources:</p>
      <div class="row">
        <div class="col-xl-6">
          <img src="img/cointelegraph_300.png" class="img-fluid">
        </div>
        <div class="col-xl-6">
          <img src="img/coingecko_1.png" class="img-fluid">
        </div>
      </div>
    </div>
  </div>
  <footer class="bg-dark text-center text-lg-left text-light fixed-bottom">
    <div class="text-center p-3">
      Copyright © CoinCap 2020
    </div>
  </footer>
</body>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.22/b-1.6.5/datatables.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>

</html>