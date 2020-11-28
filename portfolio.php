<?php

session_start();

if (!isset($_SESSION["userId"])) {
  header("location: index.php");
  exit();
}

require_once 'php/api_functions.php';

$portfolio = checkPortfolio();
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
              <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="news.php">News</a>
            </li>
          </ul>
        </div>
        <div class="dropdown">
          <a class="btn white text-dark btn-md rounded dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php echo $_SESSION["userName"]; ?>
          </a>
          <div class="dropdown-menu text-center" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item text-uppercase" href="portfolio.php">My Portfolio</a>
            <a class="dropdown-item text-uppercase text-danger" href="php/sign_out_inc.php">Sign Out</a>
          </div>
        </div>
      </div>
    </nav>
  </header>
  <div class="container" style="margin-top: 100px;">
    <?php
    if (isset($_GET["error"])) {
      if ($_GET["error"] == "coinexists") {
        echo '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                <strong>Coin is already in your portfolio.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
              </div>';
      }
    }
    if (isset($_GET["message"])) {
      if ($_GET["message"] == "coinadded") {
        echo '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                <strong>New coin successfully added.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
              </div>';
      }
      if ($_GET["message"] == "coinupdated") {
        echo '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                <strong>Coin holdings successfully updated.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
              </div>';
      }
      if ($_GET["message"] == "coindeleted") {
        echo '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                <strong>Coin successfully removed from portfolio.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
              </div>';
      }
    }
    ?>
    <?php if ($portfolio !== false) {
      echo '
      <div class="row mb-4 justify-content-center">
        <div class="col-xl-6">
          <div class="card z-depth-2 h-100 py-2 white">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="small font-weight-bold grey-text text-uppercase mb-1">
                    balance:
                  </div>
                  <div id="balance" class="h2 mb-0 text-dark">
                  </div>
                </div>
                <div class="col-auto">
                  <div id="change" class="h3 mb-0">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="mb-3 text-center">
        <a class="btn btn-success" data-toggle="modal" data-target="#addNew">
          <i class="fas fa-plus"></i>
        </a>
      </div>
      <div class="mb-4" style="padding-bottom: 60px">
        <table class="table table-responsive-xl" id="portfolio">
          <thead class="text-center stylish-color text-white">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Price</th>
              <th scope="col">24h</th>
              <th scope="col">Holdings</th>
              <th scope="col">Value</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody class="text-center">';
      getPortfolio($portfolio);
      echo '</tbody>
        </table>
      </div>';
    } else {
      echo '
        <div class=" row mb-4">
        <div class="w-100 p-4 text-center rounded shadow">
          <h2 class="mb-3">Create your cryptocurrency portfolio.</h2>
          <p class="lead mb-3">
          Press "+" sign bellow to start!
          </p>
          <a class="btn btn-success" data-toggle="modal" data-target="#addNew">
            <i class="fas fa-plus"></i>
          </a>
        </div>
      </div>';
    }
    ?>
    <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header text-center">
            <h4 class="modal-title w-100 font-weight-bold">Add New Coin</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="php/portfolio_crud_inc.php" method="post">
            <div class="modal-body mx-3">
              <div class="md-form mb-5">
                <select class="browser-default custom-select" name="coin">
                  <?php getCoinNames(); ?>
                </select>
              </div>
              <div class="md-form">
                <input type="number" step="0.0001" id="form1" class="form-control" name="holdings">
                <label for="form1">Holdings</label>
              </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
              <button class="btn btn-orange" type="submit" name="addNewCoin">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header text-center">
          <h4 class="modal-title w-100 font-weight-bold">Update coin holdings</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="php/portfolio_crud_inc.php" method="post">
          <div class="modal-body mx-3">
            <div class="md-form mb-5">
              <select class="browser-default custom-select" name="coin" id="coinName">
              </select>
            </div>
            <div class="md-form">
              <input type="number" step="0.0001" id="coinHoldings" class="form-control" name="holdings">
            </div>
          </div>
          <div class="modal-footer d-flex justify-content-center">
            <button class="btn btn-orange" type="submit" name="updateCoin">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  </div>
  </div>
  <?php if ($portfolio == false) {
    echo '<footer class="bg-dark text-center text-lg-left text-light fixed-bottom">
    <div class="text-center p-3">
      Copyright © CoinCap 2020
    </div>
  </footer>';
  } else {
    echo '<footer class="bg-dark text-center text-lg-left text-light">
    <div class="text-center p-3">
      Copyright © CoinCap 2020
    </div>
  </footer>';
  }
  ?>
</body>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.22/b-1.6.5/datatables.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#portfolio').DataTable({
      "columnDefs": [{
        orderable: false,
        targets: -1
      }]
    });
  });
</script>

<script type="text/javascript">
  var table = document.getElementById("portfolio")
  if (table != null) {
    var body = table.getElementsByTagName('tbody')[0]
    var balance = 0
    var oldBalance = 0
    for (let row of body.rows) {
      var value = parseFloat((row.cells[5].textContent).replace(/[^\d.]/g, ''))
      var change = parseFloat((row.cells[3].textContent).replace(/%/g, '')) / 100
      var oldValue = value - (change * value)

      oldBalance += oldValue
      balance += value
    }

    var currChange = (1 - (oldBalance / balance)) * 100
    document.getElementById("balance").innerHTML = '$' + balance.toFixed(2)
    document.getElementById("change").innerHTML = currChange.toFixed(2) + '%'

    if (currChange > 0) {
      document.getElementById("change").className += " text-success";
      document.getElementById("change").innerHTML = '<i class="fas fa-caret-up text-success mr-2"></i>' + document.getElementById("change").innerHTML;
    } else {
      document.getElementById("change").className += " text-danger";
      document.getElementById("change").innerHTML = '<i class="fas fa-caret-down text-danger mr-2"></i>' + document.getElementById("change").innerHTML;
    }
  }
</script>
<script type="text/javascript">
  $('.btnUpdate').click(function() {
    var row = $(this).closest('tr');
    var name = row.find('.coin_name').text();
    var holdings = row.find('.coin_holdings').text();
    $('#coinName').append('<option selected>' + name + '</option>');
    $('#coinHoldings').val(holdings);
  });
</script>

</html>