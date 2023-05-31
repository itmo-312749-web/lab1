<?php

require __DIR__ . "/vendor/autoload.php";

use App\checkers\AbstractChecker;
use App\checkers\FirstChecker;
use App\checkers\SecondChecker;
use App\checkers\ThirdChecker;
use App\Record;
use App\UserDataValidator;

session_start();
const RECORDS = "records";
if (!isset($_SESSION[RECORDS])) {
    $_SESSION[RECORDS] = [];
}

$x = $_POST["x"] ?? null;
$y = $_POST["y"] ?? null;
$radius = $_POST["radius"] ?? null;

$validator = new UserDataValidator($x, $y, $radius);

$currentRecord = null;
if ($validator->isValid()) {
    $checkers = [
        new FirstChecker((float) $x, (float) $y, (float) $radius),
        new SecondChecker((float) $x, (float) $y, (float) $radius),
        new ThirdChecker((float) $x, (float) $y, (float) $radius),
    ];
    $currentRecord = new Record(
        (float) $x,
        (float) $y,
        (float) $radius,
        $checkers
    );
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="static/icons/php-logo.svg" type="image/x-icon">
    <style>
        @import "static/styles/common.css";

        #results {
            margin: 0 auto;

            min-width: 840px;
            max-width: 1080px;

            color: #000000;

            border-radius: 1.5rem;
            border-collapse: collapse;
        }

        .header-row {
            border-radius: 1.5rem 1.5rem 0 0 ;
            background-color: #8f8f8f;
            color: #efefef;
        }

        .header-row > th:first-child{
            border-radius: 1.5rem 0 0 0;
        }

        .header-row > th:last-child{
            border-radius: 0 1.5rem 0 0;
        }

        .separator {
            height: calc(20px + 1rem);
            background: white;
        }

        .record-row {
            background-color: #ffffff;
            font-size: 1rem;
        }

        .record-row:nth-child(odd) {
            background-color: #efefef;
        }

        .record-row:last-child {
            border-radius: 0 0 1.5rem 1.5rem;
        }

        .record-row:last-child > td:first-child{
            border-radius: 0 0 0 1.5rem;
        }

        .record-row:last-child > td:last-child{
            border-radius: 0 0 1.5rem 0;
        }

        #results tr th,
        #results tr td {
            text-align: center;
            padding: 10px;
            height: fit-content;
        }

    </style>
    <title>Results</title>
</head>
<body>
    <!--Header-->
    <header>
        <ul>
            <li>Kharlamov Vladislav (ID 312749)</li>
            <li>Group P32311</li>
            <li>Variant #312749</li>
        </ul>
    </header>

    <!--Menu-->
    <div class="sidebar">
        <div class="logo-details">
            <img class="icon" src="static/icons/php-logo.svg" alt="">
            <div class="logo_name">WEB&nbsp;-&nbsp;Lab&nbsp;#1</div>
            <i class="bx bx-menu" id="btn" ></i>
        </div>
        <ul class="nav-list">
            <li id="home-btn">
                <a href="index.html">
                    <i class="bx bx-home"></i>
                    <span class="links_name">Home</span>
                </a>
                <span class="tooltip">Home</span>
            </li>
            <li id="new-point-btn">
                <a href="new.html">
                    <i class="bx bx-plus-circle"></i>
                    <span class="links_name">New Point</span>
                </a>
                <span class="tooltip">New</span>
            </li>
            <li id="results-btn" class="active">
                <a href="results.php" tabindex="-1">
                    <i class="bx bx-table"></i>
                    <span class="links_name">Results</span>
                </a>
                <span class="tooltip">Results</span>
            </li>
        </ul>
    </div>

    <div class="content">
        <div class="table-holder">
            <!--Results table-->
            <table id="results">
                <tr class="header-row">
                    <th>x</th>
                    <th>y</th>
                    <th>R</th>
                    <th>Is hit?</th>
                    <th>Timestamp</th>
                    <th>Execution time</th>
                </tr>
                <tr class="separator">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <?php foreach ($_SESSION[RECORDS] as $record): ?>
                    <?php if($record) $record = unserialize($record); ?>
                    <tr class="record-row">
                        <td class="record"><?= $record->getX() ?></td>
                        <td class="record"><?= $record->getY() ?></td>
                        <td class="record"><?= $record->getRadius() ?></td>
                        <td class="record"><?= $record->isHit() ? "Yes" : "No" ?></td>
                        <td class="record"><?= $record->getTimestampAsHumanReadableString() ?></td>
                        <td class="record"><?= $record->getHumanReadableExecutionTime() ?></td>
                    </tr>
                <?php endforeach; ?>
                <?php if ($currentRecord !== null): ?>
                    <tr class="record-row">
                        <td class="record"><?= $currentRecord->getX() ?></td>
                        <td class="record"><?= $currentRecord->getY() ?></td>
                        <td class="record"><?= $currentRecord->getRadius() ?></td>
                        <td class="record"><?= $currentRecord->isHit() ? "Yes" : "No" ?></td>
                        <td class="record"><?= $currentRecord->getTimestampAsHumanReadableString() ?></td>
                        <td class="record"><?= $currentRecord->getHumanReadableExecutionTime() ?></td>
                    </tr>
                <?php endif; ?>
            </table>
            <?php if (strtoupper($_SERVER["REQUEST_METHOD"]) === "POST" && $currentRecord === null): ?>
                <!--TODO: Incorrect request alert-->
                <div style="background-color: white; color: red">
                    !!!ALERT!!!
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php
    if ($currentRecord !== null)
        $_SESSION[RECORDS][] = serialize($currentRecord);
    ?>
    <script src="static/scripts/navigation.js"></script>
</body>
</html>

