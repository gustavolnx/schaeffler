<?php
$up = "UP X";
$dias = "365";

$planta = array(
    '0' => 'Planta 1',
    '1' => 'Planta 2'
);

$arrayUp = array(
    '0' => array(
        0 => 'UP01',
        1 => 'UP02',
        2 => 'UP07',
        3 => 'UP12',
        4 => 'UP15',
        5 => 'UP22',
        6 => 'UP28',
        7 => 'UP32.1',
        8 => 'UP32.2'
    ),
    '1' => array(
        0 => 'Usinagem',
        1 => 'Estamparia',
        2 => 'Tratamento Térmico',
        3 => 'Fábrica de mola',
        4 => 'Montagem'
    )
);



if (isset($_GET['up']) !== false) {
    $up = $arrayUp[0][$_GET['up']];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schaeffler</title>
    <link rel="stylesheet" href="../assets/styles/styles.css">
    <style>
        #buttonBack {
            bottom: 30px !important;
            left: 40px !important;
        }

        #up {
            position: absolute;
            top: 25%;
            left: 60%;
            transform: translate(-50%, -50%);
            z-index: 10;
            width: auto;
            height: 100px;
            color: #009546;
            font-family: 'MetaProBold';
            font-size: 120px;
        }


        .text-planta {
            position: absolute;
            top: 25%;
            left: 40%;
            transform: translate(-50%, -50%);
            z-index: 10;
            width: auto;
            height: 100px;
            color: #009546;
            font-family: 'MetaProBold';
            font-size: 120px;
        }


        #dias {
            position: absolute;
            top: 59%;
            left: 48%;
            transform: translate(-50%, -50%);
            z-index: 10;
            width: auto;
            height: 100px;
            color: #009546;
            font-family: 'MetaProBold';
            font-size: 120px;
        }
    </style>
</head>

<body>
    <img id="logoDefault" src="../assets/images/logo.png">
    <?php
    $watermark = "../assets/icons/dsa.png";
    include_once '../components/watermark-sm.php';

    $btnOnClick = 'history.back();';
    include_once '../components/backbutton.php';
    ?>
    <h1 id="smTitle">Dias sem <br> acidentes</h1>
    <img id="bg_dsa" src="../assets/images/bg_dsa.png">

    <div class="text-planta"><?= $planta[0] ?></div>
    <div id="up">
        <?= $up ?>
    </div>
    <div id="dias">
        <?= $dias ?>
    </div>



    <script src="../assets/javascript/chart.js"></script>
</body>

</html>