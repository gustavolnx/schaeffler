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
    $watermark = "../assets/icons/mcr.svg";
    include_once '../components/watermark-sm.php';

    $btnOnClick = 'history.back();';
    include_once '../components/backbutton.php';

    $btnOnClick = 'location.href="/schaeffler/index.php"';
    include_once '../components/home.php';
    ?>
    <h1 id="smTitle">Membros com risco</h1>
    <h5 id="upText"><?php echo $arrayUp[$planta][$up] ?></h5>

    <!-- Month picklist-->
    <div class="picklist">
        <form action="mcr.php" method="get">
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
                height: 62%;
                margin: 0 auto;
                position: absolute;
                left: 3%;
                /* border: 1px solid red; */
            }

            .qaChart2 {
                width: 24%;
                height: 68%;
                position: absolute;
                left: 74%;
                /* border: 1px solid red; */
                top: 20%;
                z-index: 400000;
            }


            .scene-2 {
                width: 100%;
                height: 100%;

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

            .image-1 {
                width: 21%;
                height: 71%;
                top: 18%;
                left: 77%;
                position: absolute;
                /* border: 1px solid red; */
            }

            #image-1 {
                width: 100%;
                height: 100%;
                object-fit: contain;
            }

            #logoAS {
                position: absolute;
                padding-inline: 10px;
                padding-block: 20px;
                bottom: 0;
                right: 0;
                width: 150px;
                z-index: 300;
            }

            #picklist {
                position: absolute;
                top: 18%;
                left: 12%;
                transform: translateX(-100%);
                width: auto;
                height: auto;
                /* border: 1px solid red; */
                z-index: 100;
            }
        </style>
        <div class="qaChart">
            <canvas id="myChart"></canvas>
        </div>
        <div class="scene-2">
            <div class="qaChart2">
                <canvas id="myChart2"></canvas>
            </div>
            <div class="image-1">
                <img id="image-1" src="../assets/images/boneco.png"></img>
            </div>

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
                    label: 'Estratificação com Membro em risco',
                    data: [20, 10, 8, 4],
                    backgroundColor: ['#008000', '#800080', '#4444FF', '#5397FD'],
                    borderColor: '#9BD0F5',
                }],
                labels: ['Mão', 'Ombros', 'Pé', 'Joelho']

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
                    },
                    indexAxis: 'y',
                }
            });
        </script>
        <script>
            const ctx2 = document.getElementById('myChart2');

            new Chart(ctx2, {
                type: 'bubble',
                data: {
                    labels: ['Mão', 'Ombros', 'Joelho', 'Pé'],
                    datasets: [{
                        label: ['Membro com risco'],
                        data: [{
                                // x = horizontal >>>
                                // y = vertical 

                                // M'ao
                                x: 140,
                                y: 240,
                                r: 20 * 2.5
                            }, {
                                // Ombro
                                x: 200,
                                y: 400,
                                r: 10 * 2.5
                            },
                            // Pé
                            {
                                x: 200,
                                y: 150,
                                r: 8 * 2.5
                            }, {
                                x: 360,
                                y: 20,
                                r: 4 * 2.5
                            }

                        ],
                        backgroundColor: ['rgba(0,128,0,0.5)', 'rgba(128,0,128,0.5)', 'rgba(83,151,253,0.5)', 'rgba(68,68,255,0.5)'],
                    }]
                },
                options: {

                    animation: {
                        duration: 0
                    },
                    plugins: {
                        legend: {

                            display: false,
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    var label = (context.raw.r / 2.5);
                                    return label;
                                }
                            }
                        }

                    },

                    reponsive: true,
                    maintainAspectRatio: false,

                    scales: {
                        y: {
                            min: 0,
                            max: 500,
                            grid: {
                                display: false
                            },
                            border: {
                                display: false
                            },
                            ticks: {
                                display: false
                            },
                            beginAtZero: false

                        },
                        x: {
                            min: 0,
                            max: 500,
                            grid: {
                                display: false
                            },
                            ticks: {
                                display: false
                            },
                            border: {
                                display: false
                            },


                        },

                    }
                }
            });
        </script>
</body>

</html>