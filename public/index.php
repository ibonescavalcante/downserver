<?php
declare(strict_types=1);

include_once '../src/utils/autorizacao.php';
$os = detectOperatingSystem();
$browser = detectBrowser();
$geo = getGeo($_SERVER['REMOTE_ADDR'] ?? '');
$country = $geo->country ?? '';
$countryCode = $geo->countryCode ?? '';
echo "OS: " . $os . "<br>";
echo "Browser: " . $browser . "<br>";
echo "País: " . $country . "<br>";
echo "Código do país: " . $countryCode . "<br>";


header('Content-Type: text/html; charset=utf-8');
echo $_SERVER['REQUEST_URI'] ;
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <title>Início</title>
</head>
<body>
    <h1>Raiz (public/index.php)</h1>
    <p>Fallback do <code>try_files</code> em <code>location /</code>.</p>
    <p><strong>REQUEST_URI:</strong> <?= htmlspecialchars($_SERVER['REQUEST_URI'] ?? '') ?></p>
</body>
</html>
