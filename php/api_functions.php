<?php

require('vendor/autoload.php');

use Codenixsv\CoinGeckoApi\CoinGeckoClient;

$client = new CoinGeckoClient();
$data = $client->coins()->getMarkets('usd');
$global_data = $client->globals()->getGlobal();

$total_market = number_format($global_data["data"]["total_market_cap"]["usd"]);
$volume = number_format($global_data["data"]["total_volume"]["usd"]);
$btc_dominance = number_format($global_data["data"]["market_cap_percentage"]["btc"], 2, ".", ",");
$change = number_format($global_data["data"]["market_cap_change_percentage_24h_usd"], 2, ".", ",");

foreach ($data as $ch) {
  $changes[] = number_format($ch["price_change_percentage_24h"], 2, ".", ",");
  $names[] = $ch["symbol"];
  $images[] = $ch["image"];
  $prices[] = $ch["current_price"];
}

$combined = array_map(null, $changes, $names, $images, $prices);
asort($combined);

$high = array_slice($combined, -5);
$low = array_slice($combined, 0, 5);

function pills()
{
  global $high;
  global $low;

  foreach ($high as $h) {
    echo '
          <span class="small text-success font-weight-bold text-uppercase"><i class="fas fa-caret-up text-success"></i>
          ' . $h[0] . '% <span class="text-dark">' . $h[1] . '</span>
      </span>';
  }
  foreach ($low as $l) {
    echo '
          <span class="small text-danger font-weight-bold text-uppercase"><i class="fas fa-caret-down text-danger"></i>
          ' . $l[0] . '% <span class="text-dark">' . $l[1] . '</span>
      </span>';
  }
}

function getTable()
{
  global $data;
  $counter = 1;
  foreach ($data as $line) {
    echo '<tr>
        <th>' . $counter . '</td>
        <td>' . '<img class="mr-2" style="width: 25px" src="' . $line["image"] . '"/>' . " " . $line["name"] . " " .
      '<span class="small font-weight-bold  text-uppercase">' . $line["symbol"] . '</span></td>
        <td>$' . number_format($line["current_price"], 3, ".", ",") . '</td>
        <td>';
    if (substr(strval($line["price_change_percentage_24h"]), 0, 1) == "-") {
      echo '<i class="fas fa-caret-down text-danger"></i><span class="text-danger font-weight-normal">' . number_format($line["price_change_percentage_24h"], 2, ".", ",") . '%</span></td>';
    } else {
      echo '<i class="fas fa-caret-up text-success"></i><span class="text-success font-weight-normal">' . number_format($line["price_change_percentage_24h"], 2, ".", ",") . '%</span></td>';
    }
    echo '<td>$' . number_format($line["total_volume"]) . '</td>
                  <td>$' . number_format($line["market_cap"]) . '</td>
              </tr>';
    $counter++;
  }
}

function getCoinNames()
{
  global $names;
  foreach ($names as $name) {


    echo '<option>' . strtoupper($name) . '</option>';
  }
}

function checkPortfolio()
{
  $user = $_SESSION["userId"];

  require_once 'db.php';

  $sql = "SELECT * FROM coins WHERE userId = ?";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location:  ../sign_in.php?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "s", $user);
  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);

  if ($data = mysqli_fetch_all($resultData)) {
    return $data;
  } else {
    $result = false;
    return $result;
  }
}

function getPortfolio($portfolio)
{
  global $combined;
  $user = $_SESSION["userId"];
  $counter = 1;
  $change = '';
  $price = '';
  $image = '';
  foreach ($portfolio as $p) {
    foreach ($combined as $asset) {
      $name = strtoupper($asset[1]);
      if ($name == $p[2]) {
        $change = $asset[0];
        $price = $asset[3];
        $image = $asset[2];
      }
    }
    echo '
    <tr>
      <td>' . $counter . '</td>
      <td><img class="mr-2" src="' . $image . '" style="width: 25px"><span class="coin_name font-weight-bold">' . $p[2] . '</span></td>
      <td>$' . round((float)$price, 4) . '</td>';
    if (substr(strval($change), 0, 1) == "-") {
      echo '<td><i class="fas fa-caret-down text-danger"></i><span class="text-danger font-weight-normal">' . $change . '%</span></td>';
    } else {
      echo '<td><i class="fas fa-caret-up text-success"></i><span class="text-success font-weight-normal">' . $change . '%</span></td>';
    }
    echo '<td class="coin_holdings">' . $p[3] . '</td>
      <td>$' . round(((float)$p[3] * $price), 4) . '</td>
      <td><a class="btnUpdate btn rounded btn-blue-grey btn-sm" data-toggle="modal" data-target="#update"><i class="fas fa-pencil-alt"></i></a>
        <a class="btn rounded btn-danger btn-sm ml-2" href="php/portfolio_crud_inc.php?userId=' . $user . '&coin=' . $p[2] . '"><i class="far fa-trash-alt"></i></a>
      </td>
    </tr>
';
    $counter++;
  }
}
