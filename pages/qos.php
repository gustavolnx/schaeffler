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
    <h1 id="smTitle">QOS</h1>
    <h5 id="upText"><?php echo $arrayUp[$planta][$up] ?></h5>

    <!-- Month picklist-->
    <div class="picklist">
        <form action="qos.php" method="get">
            <div id="picklist">

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


            .scene-10 {
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

            .scene-10 a {
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

            .scene-1 {
                width: 100%;
                height: 100%;
                left: 0%;
                top: 0%;
                position: absolute;
                display: none;
                /* border: 1px solid red; */
            }

            .scene-2 {
                width: 100%;
                height: 100%;
                left: 0%;
                top: 0%;
                position: absolute;
                display: none;
                /* border: 1px solid red; */
            }

            .scene-3 {
                width: 100%;
                height: 100%;
                left: 0%;
                top: 0%;
                position: absolute;
                display: none;
                /* border: 1px solid red; */
            }

            .scene-4 {
                width: 100%;
                height: 100%;
                left: 0%;
                top: 0%;
                position: absolute;
                display: none;
                /* border: 1px solid red; */
            }

            .scene-5 {
                width: 100%;
                height: 100%;
                left: 0%;
                top: 0%;
                position: absolute;
                display: none;
                /* border: 1px solid red; */
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
        <div class="scene-1" id="scene-1">
            <div class="qaChart">
                <canvas id="myChart"></canvas>
            </div>

        </div>

        <div class="scene-2" id="scene-2">
            <div class="qaChart">
                <canvas id="myChart2"></canvas>
            </div>
        </div>

        <div class="scene-3" id="scene-3">
            <div class="qaChart">
                <canvas id="myChart3"></canvas>
            </div>
        </div>

        <div class="scene-4" id="scene-4">
            <div class="qaChart">
                <canvas id="myChart4"></canvas>
            </div>
        </div>

        <div class="scene-5" id="scene-5">
            <div class="qaChart">
                <canvas id="myChart5"></canvas>
            </div>
        </div>


        <div class="scene-10">
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
                    label: 'Atual acumulado',
                    data: [700, 8000, 10000, 15533, 20183, 24833, 37000, 34133, 40000]
                }, {
                    type: 'line',
                    label: 'Bugdet acumulado',
                    data: [700, 6000, 11300, 16600, 21900, 27200, 32500, 37800, 43100],
                }],
                labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',
                    'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'
                ]
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

        <!-- Consumption -->

        <script>
            // 
            // 
            //chartData
            var chartData2 = {
                datasets: [{
                    type: 'bar',
                    label: 'Atual acumulado',
                    data: [27, 800, 1573, 2346, 3119, 3892, 4665, 5438, 6211]
                }, {
                    type: 'line',
                    label: 'Bugdet acumulado',
                    data: [1, 3, 1, 0, 1, 8, 1, 1, 1],
                }],
                labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',
                    'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'
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
                    label: 'Atual acumulado(%)',
                    data: [0.78, 0.90, 1.02, 1.14, 1.26, 1.38, 1.50, 1.62, 1.74]
                }, {
                    type: 'line',
                    label: 'Bugdet acumulado(%)',
                    data: [0.55, 0.98, 1.41, 1.84, 2.27, 2.70, 3.13, 3.56, 3.99],
                }],
                labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',
                    'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'
                ]
            };


            const ctx3 = document.getElementById('myChart3');

            new Chart(ctx3, {
                type: 'bar',
                data: chartData3,

                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
        <!-- Complaints -->
        <script>
            // 
            // 
            //chartData
            var chartData4 = {
                datasets: [{
                    type: 'bar',
                    label: 'Atual acumulado',
                    data: [3.0, 3.0, 3.0, 3.0, 3.0, 3.0, 3.0, 3.0, 3.0]
                }, {
                    type: 'line',
                    label: 'Bugdet acumulado',
                    data: [2.98, 2.98, 2.98, 2.98, 2.98, 2.98, 2.98, 2.98, 2.98],
                }],
                labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',
                    'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'
                ]
            };


            const ctx4 = document.getElementById('myChart4');

            new Chart(ctx4, {
                type: 'bar',
                data: chartData4,

                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>

        <!-- Hit to promise -->
        <script>
            // 
            // 
            //chartData
            var chartData5 = {
                datasets: [{
                    type: 'bar',
                    label: 'Atual acumulado(%)',
                    data: [91, 89, 87, 86, 84, 82, 91, 89, 78]
                }, {
                    type: 'line',
                    label: 'Bugdet acumulado(%)',
                    data: [55, 55, 55, 55, 55, 55, 55, 55, 55],
                }],
                labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',
                    'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'
                ]
            };


            const ctx5 = document.getElementById('myChart5');

            new Chart(ctx5, {
                type: 'bar',
                data: chartData5,

                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
        <script src="../assets/javascript/qos.js"></script>
</body>

</html>