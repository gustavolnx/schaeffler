<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schaeffler</title>
    <link rel="stylesheet" href="./assets/styles/styles.css">
</head>


<body>
    <div id="bgWhite"></div>
    <img id="solari" src="./assets/images/solari.jpg">
    <img id="logoAS" src="./assets/images/logo-as.jpg">
    <img id="speechBubble" src="./assets/images/speechBubble.png">
    <div id="speechBubbleText">

    </div>
    <div id="emergencyNumber">Ramal de emergência: XXXX</div>
    <img id="logoDefault" src="./assets/images/logo.png">

    <?php
    $watermark = "./assets/icons/watermark-home.png";
    include_once 'components/watermark.php';
    ?>
    <h1 id="bigTitle">Segurança <br> do Trabalho</h1>
    <style>
        .qa {
            top: calc(36.5% - 90px);
            left: calc(24.8% - 17% - 90px);
        }
    </style>
    <?php
    $buttonstate = 'qa';
    $text = 'Quase acidentes';
    $btnUrl = '"./pages/qa.php"';
    include 'components/roundbutton.php';
    ?>
    <style>
        .dsa {
            top: calc(36.5% - 90px);
            left: calc(39.8% - 17% - 90px);
        }
    </style>
    <?php
    $buttonstate = 'dsa';
    $text = 'Dias sem acidentes';
    $btnUrl = '"./pages/dsa_chart.php"';
    include 'components/roundbutton.php';
    ?>
    <style>
        .qos {
            top: calc(36.5% - 90px);
            left: calc(54.8% - 17% - 90px);
        }
    </style>
    <?php
    $buttonstate = 'qos';
    $text = 'QOS';
    $btnUrl = '"./pages/qos_chart.php"';

    include 'components/roundbutton.php';
    ?>
    <style>
        .acp {
            top: calc(36.5% - 90px);
            left: calc(54.8% - 2% - 90px);
        }
    </style>
    <?php
    $buttonstate = 'acp';
    $text = 'Acidentes com Afastamento';
    $btnUrl = '"./pages/caf_chart.php"';

    include 'components/roundbutton.php';
    ?>
    <style>
        .acd {
            top: calc(71.5% - 90px);
            left: calc(24.8% - 17% - 90px);
        }
    </style>
    <?php
    $buttonstate = 'acd';
    $text = 'Acidentes';
    $btnUrl = '"./pages/acd.php"';

    include 'components/roundbutton.php';
    ?>
    <style>
        .mcr {
            top: calc(71.5% - 90px);
            left: calc(24.8% - 2% - 90px);
        }
    </style>
    <?php
    $buttonstate = 'mcr';
    $text = 'Membros com risco';
    $btnUrl = '"./pages/mcr.php"';

    include 'components/roundbutton.php';
    ?>
    <style>
        .dss {
            top: calc(71.5% - 90px);
            left: calc(24.8% + 13% - 90px);
        }
    </style>
    <?php
    $buttonstate = 'dss';
    $text = 'DSS';
    $btnUrl = '"./pages/dss.php"';

    include 'components/roundbutton.php';
    ?>
    <style>
        .hierarquia {
            top: calc(71.5% - 90px);
            left: calc(24.8% + 28% - 90px);
        }
    </style>
    <?php
    $buttonstate = 'hierarquia';
    $text = 'Hierarquia';
    $btnUrl = '"./pages/hierarquia.php"';

    include 'components/roundbutton.php';
    ?>


    <!-- Frases automaticas -->

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Array de frases
            var frases = [
                "A segurança no trabalho é alicerçada na prevenção; protegendo nossos colaboradores, construímos um ambiente produtivo e livre de acidentes.",
                "Em nossa fábrica, a cultura da segurança é a peça fundamental que assegura que todos possam voltar para casa com saúde e integridade todos os dias.",
                "Cada ação segura no chão de fábrica é um passo em direção a um ambiente mais seguro. Investimos na conscientização para garantir a segurança de todos os trabalhadores.",
                "Na busca pela eficiência, nunca comprometemos a segurança. Acreditamos que operações seguras resultam em produção consistente e qualidade superior.",
                "Nossa fábrica é um espaço onde a responsabilidade individual se une à segurança coletiva. Juntos, construímos uma cultura que valoriza a vida e a saúde de cada membro da equipe.",

                // Só colocar mais frases aqui que ele irá puxar automaticamente
            ];

            // Atualizar o texto a cada 5 minutos
            function updateSpeechBubbleText() {
                var speechBubbleText = document.getElementById("speechBubbleText");
                var randomIndex = Math.floor(Math.random() * frases.length);
                speechBubbleText.innerHTML = "<p>" + frases[randomIndex] + "</p>";
            }


            updateSpeechBubbleText();

            // Editar o tempo de atualização aqui
            setInterval(updateSpeechBubbleText, 5 * 60 * 1000);
        });
    </script>

</body>

</html>