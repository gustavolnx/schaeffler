<?php

$planta = $_GET['planta'];


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
    $watermark = "../assets/icons/acp.png";
    include_once '../components/watermark-sm.php';

    $btnOnClick = 'history.back();';
    include_once '../components/backbutton.php';

    $btnOnClick = 'location.href="/schaeffler/index.php"';
    include_once '../components/home.php';
    ?>
    <h1 id="smTitle">Acidentes CAF</h1>
    <h5 id="upText"><?php echo $arrayUp[$planta][$up] ?></h5>

    <!-- Month picklist-->
    <div class="picklist">
        <form action="qa_upchart.php" method="get">
            <div id="picklist">
                <!-- <select id='picklistMonth' name="month" onchange="this.form.submit()">
                    <?php
                    foreach ($activeDates[$year] as $key => $value) {
                        if ($key == $month) {
                            echo "<option value='{$key}' selected>{$value}</option>";
                        } else {
                            echo "<option value='{$key}'>{$value}</option>";
                        }
                    }
                    ?>
                </select> -->
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
            .btn-1 {
                width: 19%;
                height: 8%;
                left: 10%;
                top: 90%;
                background-color: #009446;
                border-radius: 2vw;
                position: absolute;
            }

            .btn-2 {
                width: 19%;
                height: 8%;
                left: 31%;
                top: 90%;
                background-color: #009446;
                border-radius: 2vw;
                position: absolute;
            }

            .btn-3 {
                width: 19%;
                height: 8%;
                left: 52%;
                top: 90%;
                background-color: #009446;
                border-radius: 2vw;
                position: absolute;
            }


            .btn-1 a,
            .btn-2 a,
            .btn-3 a {
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
            .btn-3 {
                cursor: pointer;
            }

            * {
                overflow: hidden;
            }

            .scene-2 {
                width: 100%;
                height: 100%;
                position: absolute;

            }

            .qaChart {
                width: 85%;
                height: 66%;
                margin: 0 auto;
                position: absolute;
                /* border: 1px solid red; */
            }

            .scene-3 {
                width: 100%;
                height: 100%;
                position: absolute;
                display: none;

            }

            .scene-4 {
                width: 100%;
                height: 100%;
                position: absolute;
                display: none;

            }

            #picklist {
                position: absolute;
                top: 18%;
                left: 18%;
                transform: translateX(-100%);
                width: auto;
                height: auto;
                /* border: 1px solid red; */
                z-index: 100;
            }
        </style>
        <div class="scene-2" id="scene-2">
            <div class="qaChart">
                <canvas id="myChart"></canvas>
            </div>
        </div>
        <div class="scene-3" id="scene-3">
            <div class="qaChart">
                <canvas id="myChart2"></canvas>
            </div>
        </div>
        <div class="scene-4" id="scene-4">
            <div class="qaChart">
                <canvas id="myChart3"></canvas>
            </div>
        </div>
        <div class="btn-1" id="btn-1"><a>Acidentes CAF</a></div>
        <div class="btn-2" id="btn-2"><a>Dias perdidos</a></div>
        <div class="btn-3" id="btn-3"><a>Acidentes por setor</a></div>


        <script>
            var up = <?php echo $up ?>;
            var year = <?php echo $year ?>;

            // Form picklist value

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
                    label: '',
                    data: [10, 20, 30, 40, 57, 60, 70, 80, 90, 72, 110, 52],

                }, {
                    type: 'line',
                    label: '',
                    data: [10, 22, 2, 40, 57, 60, 70, 80, 90, 72, 110, 52],
                }],
                labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto',
                    'Setembro', 'Outubro', 'Novembro', 'Dezembro'
                ]
            };


            const ctx = document.getElementById('myChart');

            new Chart(ctx, {
                type: 'bar',
                data: chartData,

                options: {
                    plugins: {
                        legend: {
                            labels: {
                                filter: function(legendItem, data) {
                                    let label = data.datasets[legendItem.datasetIndex].label || '';
                                    if (typeof(label) !== 'undefined') {
                                        if (legendItem.datasetIndex >= 3) {
                                            return false;
                                        }
                                    }
                                    return label;
                                }
                            }
                        }
                    },


                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
        <script>
            var chartData2 = {

                datasets: [{
                    label: 'Acidentes por setor',
                    data: [30, 40, 50, 5, 8, 30, 40, 50, 5, 8, 30, 40],
                    backgroundColor: ['#ffff00', '#00b050', '#ff9500', '#3568c1'],
                    borderColor: '#9BD0F5',
                }],
                labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto',
                    'Setembro', 'Outubro', 'Novembro', 'Dezembro'
                ]

            };


            const ctx2 = document.getElementById('myChart2');

            new Chart(ctx2, {
                type: 'bar',
                data: chartData2,

                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>

        <script>
            // 
            // 
            //chartData
            var chartData3 = {
                datasets: [{
                    type: 'bar',
                    label: '',
                    data: [5, 10, 16, 20, 26, 33, 44, 11, 23, 55, 122, 51],

                }, {
                    type: 'line',
                    label: '',
                    data: [11, 2, 22, 21, 54, 60, 70, 80, 90, 72, 50, 52],
                }],
                labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto',
                    'Setembro', 'Outubro', 'Novembro', 'Dezembro'
                ]
            };


            const ctx3 = document.getElementById('myChart3');

            new Chart(ctx3, {
                type: 'bar',
                data: chartData3,

                options: {
                    plugins: {
                        legend: {
                            labels: {
                                filter: function(legendItem, data) {
                                    let label = data.datasets[legendItem.datasetIndex].label || '';
                                    if (typeof(label) !== 'undefined') {
                                        if (legendItem.datasetIndex >= 3) {
                                            return false;
                                        }
                                    }
                                    return label;
                                }
                            }
                        }
                    },


                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
        <script src="../assets/javascript/script.js"></script>
</body>

</html>