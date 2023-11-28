<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schaeffler</title>
    <link rel="stylesheet" href="../assets/styles/styles.css">
</head>

<body>
    <img id="logoAS" src="../assets/images/logo-as.jpg">
    <img id="logoDefault" src="../assets/images/logo.png">
    <?php
    $watermark = "../assets/icons/acd.png";
    include_once '../components/watermark-sm.php';

    $btnOnClick = 'history.back();';
    include_once '../components/backbutton.php';
    ?>
    <h1 id="smTitle">Acidentes</h1>

    <div class="title1">Planta 1</div>
    <div class="chartArea1">
        <canvas id="myChart9"></canvas>
    </div>
    <div class="title2">Planta 2</div>
    <div class="chartArea2">
        <canvas id="myChart10"></canvas>
    </div>

    <script src="../assets/javascript/chart.js"></script>
    <script src="../assets/javascript/homeChart9.js"></script>
    <script src="../assets/javascript/homeChart10.js"></script>
</body>

</html>