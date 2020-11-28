<?php
session_start();
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
    <nav class="navbar navbar-expand-lg navbar-dark primary-color-dark fixed-top">
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
            <li class="nav-item active">
              <a class="nav-link" href="contact.php">Contact</a>
            </li>
            <li class="nav-item">
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
  <div style="margin-top: 70px;">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2781.7890741539636!2d15.966758816056517!3d45.795453279106205!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4765d68b5d094979%3A0xda8bfa8459b67560!2sUl.+Vrbik+VIII%2C+10000%2C+Zagreb!5e0!3m2!1shr!2shr!4v1509296660756" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
  </div>
  <div class="container">
    <section class="mb-4">
      <h2 class="h1-responsive text-center my-4">Contact us</h2>
      <p class="lead text-muted text-center w-responsive mx-auto mb-5">If you have any questions please do not hesitate to contact us directly.</p>
      <div class="row">
        <div class="col-md-9 mb-md-0 mb-5">
          <form id="contact-form" name="contact-form" action="php/contact_inc.php" method="POST">
            <div class="row">
              <div class="col-md-6">
                <div class="md-form mb-0">
                  <input type="text" id="name" name="name" class="form-control">
                  <label for="name" class="">Your name</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="md-form mb-0">
                  <input type="text" id="email" name="email" class="form-control">
                  <label for="email" class="">Your email</label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="md-form mb-0">
                  <input type="text" id="subject" name="subject" class="form-control">
                  <label for="subject" class="">Subject</label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="md-form">
                  <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea"></textarea>
                  <label for="message">Your message</label>
                </div>
              </div>
            </div>
          </form>
          <div class="text-center text-md-center">
            <a class="btn btn-amber" onclick="document.getElementById('contact-form').submit();">Send</a>
          </div>
          <div class="status"></div>
        </div>
        <div class="col-md-3 text-center">
          <ul class="list-unstyled mb-0">
            <li><i class="fas fa-map-marker-alt fa-2x text-primary"></i>
              <p>Vrbik, 10000 Zagreb</p>
            </li>

            <li><i class="fas fa-phone mt-4 fa-2x text-primary"></i>
              <p>+385 1 123 223</p>
            </li>
            <li><i class="fas fa-envelope mt-4 fa-2x text-primary"></i>
              <p>mkaurin@tvz.hr</p>
            </li>
          </ul>
        </div>
      </div>
    </section>
  </div>
  <footer class="bg-dark text-center text-lg-left text-light">
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