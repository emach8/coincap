<?php

require('vendor/autoload.php');

$src = new Feed();

function getBitcoinRss()
{
    global $src;
    $counter = 0;
    $rss = $src->loadRss('https://cointelegraph.com/rss/tag/bitcoin');

    foreach ($rss->item as $item) {
        if ($counter < 10) {
            $finds = [
                '~^<!\[CDATA\[~',
                '~\]\]>$~'
            ];

            $title = $item->title;
            $link = $item->link;
            $timestamp = $item->pubDate;
            $description = trim(strip_tags(preg_replace($finds, '', $item->description)));

            preg_replace("/<img[^>]+\>/i", "", $description);
            $image = (string)$item->enclosure['url'][0];

            echo '<div class="col-xl-12">
            <div class="card mb-3 hoverable">
            <div class="row g-0"> 
                <div class="col-xl-3 col-md-3">
                <img
                    src="' .  $image . '"
                    alt="..."
                    class="img-fluid rounded"
                />
                </div>
                <div class="col-xl-9 col-md-9">
                <div class="card-body">
                    <a class="text-dark" href="' . $link . '" target="blank"><h6 class="card-title font-weight-bold">' . $title . '</h6></a>
                    <p class="card-text font-weight-light">' . $description . '</p>
                    <p class="card-text">
                    <small class="font-weight-lighter font-italic">' . $timestamp . '</small>
                    </p>
                </div>
                </div>
            </div>
            </div>
            </div>';

            $counter++;
        }
    }
}

function getAltcoinRss()
{
    global $src;
    $counter = 0;
    $rss = $src->loadRss('https://cointelegraph.com/rss/tag/altcoin');

    foreach ($rss->item as $item) {
        if ($counter < 10) {
            $finds = [
                '~^<!\[CDATA\[~',
                '~\]\]>$~'
            ];

            $title = $item->title;
            $link = $item->link;
            $timestamp = $item->pubDate;
            $description = trim(strip_tags(preg_replace($finds, '', $item->description)));

            preg_replace("/<img[^>]+\>/i", "", $description);
            $image = (string)$item->enclosure['url'][0];

            echo '<div class="col-xl-12">
            <div class="card mb-3 hoverable">
            <div class="row g-0">
                <div class="col-xl-3 col-md-3">
                <img
                    src="' .  $image . '"
                    alt="..."
                    class="img-fluid rounded"
                />
                </div>
                <div class="col-xl-9 col-md-9">
                <div class="card-body">
                    <a class="text-dark" href="' . $link . '" target="blank"><h6 class="card-title font-weight-bold">' . $title . '</h6></a>
                    <p class="card-text font-weight-light">' . $description . '</p>
                    <p class="card-text">
                    <small class="font-weight-lighter font-italic">' . $timestamp . '</small>
                    </p>
                </div>
                </div>
            </div>
            </div>
            </div>';

            $counter++;
        }
    }
}

function getBlockChainRss()
{
    global $src;
    $counter = 0;
    $rss = $src->loadRss('https://cointelegraph.com/rss/tag/blockchain');

    foreach ($rss->item as $item) {
        if ($counter < 10) {
            $finds = [
                '~^<!\[CDATA\[~',
                '~\]\]>$~'
            ];

            $title = $item->title;
            $link = $item->link;
            $timestamp = $item->pubDate;
            $description = trim(strip_tags(preg_replace($finds, '', $item->description)));

            preg_replace("/<img[^>]+\>/i", "", $description);
            $image = (string)$item->enclosure['url'][0];

            echo '<div class="col-xl-12">
            <div class="card mb-3 hoverable">
            <div class="row g-0">
                <div class="col-xl-3 col-md-3">
                <img
                    src="' .  $image . '"
                    alt="..."
                    class="img-fluid rounded"
                />
                </div>
                <div class="col-xl-9 col-md-9">
                <div class="card-body">
                    <a class="text-dark" href="' . $link . '" target="blank"><h6 class="card-title font-weight-bold">' . $title . '</h6></a>
                    <p class="card-text font-weight-light">' . $description . '</p>
                    <p class="card-text">
                    <small class="font-weight-lighter font-italic">' . $timestamp . '</small>
                    </p>
                </div>
                </div>
            </div>
            </div>
            </div>';

            $counter++;
        }
    }
}
