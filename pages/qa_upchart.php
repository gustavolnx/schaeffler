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
    $watermark = "../assets/icons/qa.png";
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
        <form action="qa_upchart.php" method="get">
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
    </div>


    <div class="qaChart">
        <canvas id="myChart"></canvas>
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
        var json = <?php echo $qaJson ?>;
        var data = json[up];
        //For each in array, check for .ano
        for (var i = 0; i < data.length; i++) {
            if (data[i].ano == year) {
                //If .ano == year, get .dados
                var dados = data[i].dados;
            }
        }

        // console.log(dados);
        var month = month - 1;
        arrDados = {
            "ANDAMENTO": dados[month].andamento,
            "CONCLUIDA": dados[month].concluida,
            "ANALISADA": dados[month].analisada,
            "TOTAL": dados[month].total

        }




        console.log(arrDados);
        console.log(month);
        console.log(dados[month].mes);
        // 
        // 
        //chartData
        var chartData = {

            datasets: [{
                label: 'Quase acidentes',
                data: arrDados,
                backgroundColor: ['#ffff00', '#00b050', '#ff9500', '#3568c1'],
                borderColor: '#9BD0F5',
            }],

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