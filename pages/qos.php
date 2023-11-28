<?php

if (isset($_GET['planta']) == false) {
    $planta = 0;
} else {
    $planta = $_GET['planta'];
}





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



$activeDates = array(
    '2022' => array(
        '11' => 'Novembro',
        '12' => 'Dezembro',
    ),
    '2023' => array(
        '1' => 'Janeiro',
        '2' => 'Fevereiro',
    ),
);



if (isset($_GET['up']) !== false) {
    $up = $_GET['up'];
    if (isset($_GET['year']) == false) {
        //Get max possible year
        $year = max(array_keys($activeDates));
    } else {
        $year = $_GET['year'];
    }
    if (isset($_GET['month']) == false) {
        //Get max possible month
        $month = max(array_keys($activeDates[$year]));
    } else {
        $month = $_GET['month'];
    }
    // get max possible days based on arrDays

} else {
    $up = 0;
}


//GET JSON DATA
$qaJson = file_get_contents('../assets/json/qa.json');
?>
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
    $watermark = "../assets/icons/qos.png";
    include_once '../components/watermark-sm.php';

    $btnOnClick = 'history.back();';
    include_once '../components/backbutton.php';

    $btnOnClick = 'location.href="/schaeffler/index.php"';
    include_once '../components/home.php';
    ?>
    <h1 id="smTitle">Quase acidentes</h1>
    <h5 id="upText"><?php echo $arrayUp[$planta][$up] ?></h5>

    <!-- Month picklist-->
    <div class="picklist">
        <form action="qos.php" method="get">
            <div id="picklist">
                <select id='picklistMonth' name="month" onchange="this.form.submit()">
                    <?php
                    foreach ($activeDates[$year] as $key => $value) {
                        if ($key == $month) {
                            echo "<option value='{$key}' selected>{$value}</option>";
                        } else {
                            echo "<option value='{$key}'>{$value}</option>";
                        }
                    }
                    ?>
                </select>
                <!-- Year picklist -->
                <select id='picklistYear' name="year" onchange="this.form.submit()">
                    <?php
                    foreach ($activeDates as $key => $value) {
                        if ($key == $year) {
                            echo "<option value='{$key}' selected>{$key}</option>";
                        } else {
                            echo "<option value='{$key}'>{$key}</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <!-- Hidden up -->
            <input type="hidden" name="up" value="<?php echo $up ?>">
            <!-- Hidden planta -->
            <input type="hidden" name="planta" value="<?php echo $planta ?>">
        </form>
        <style>
            .qaChart {
                width: 85%;
                height: 66%;
                margin: 0 auto;
                position: absolute;
                /* border: 1px solid red; */
            }


            .scene-2 {
                width: 78%;
                height: 8.5%;
                left: 10%;
                top: 90%;
                /* background-color: red; */
                position: absolute;
                /* border: 1px solid red; */
            }

            .btn-1 {
                width: 15%;
                height: 70%;
                left: 0%;
                top: 0%;
                background-color: #009446;
                border-radius: 2vw;
                position: absolute;
            }

            .btn-2 {
                width: 15%;
                height: 70%;
                left: 16%;
                top: 0%;
                background-color: #009446;
                border-radius: 2vw;
                position: absolute;
            }

            .btn-3 {
                width: 23%;
                height: 70%;
                left: 32%;
                top: 0%;
                background-color: #009446;
                border-radius: 2vw;
                position: absolute;
            }

            .btn-4 {
                width: 15%;
                height: 70%;
                left: 56%;
                top: 0%;
                background-color: #009446;
                border-radius: 2vw;
                position: absolute;
            }

            .btn-5 {
                width: 25%;
                height: 70%;
                left: 72%;
                top: 0%;
                background-color: #009446;
                border-radius: 2vw;
                position: absolute;
            }

            .scene-2 a {
                font-family: 'Roboto', sans-serif;
                font-size: 1.3vw;
                font-weight: bold;
                color: white;
                text-align: center;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }


            .btn-1,
            .btn-2,
            .btn-3,
            .btn-4,
            .btn-5 {
                cursor: pointer;
            }
        </style>
        <div class="qaChart">
            <canvas id="myChart"></canvas>
        </div>
        <div class="scene-2">
            <div class="btn-1"><a>Production</a></div>
            <div class="btn-2"><a>Consumption</a></div>
            <div class="btn-3"><a>Quality Cost</a></div>
            <div class="btn-4"><a>Complaints</a></div>
            <div class="btn-5"><a>Hit to promisse</a></div>
        </div>


        <script>
            var up = <?php echo $up ?>;
            var month = <?php echo $month ?>;
            var year = <?php echo $year ?>;

            // Form picklist value
            document.getElementsByName('month')[0].value = month;
            document.getElementsByName('year')[0].value = year;
        </script>

        <script src="../assets/javascript/chart.js"></script>
        <script>
            // 
            // 
            //chartData
            var chartData = {
                datasets: [{
                    type: 'bar',
                    label: 'Meta',
                    data: [10, 20, 30, 40]
                }, {
                    type: 'line',
                    label: 'Atual',
                    data: [8, 10, 28, 10],
                }],
                labels: [1, 2, 3, 6, 7, 8, 9, 10, 13, 14, 15, 16, 17, 20, 21, 22, 23, 24, 27, 28, 29, 30]
            };


            const ctx = document.getElementById('myChart');

            new Chart(ctx, {
                type: 'bar',
                data: chartData,

                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
</body>

</html>