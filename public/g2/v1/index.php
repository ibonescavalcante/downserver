<?php
declare(strict_types=1);

header('Content-Type: text/html; charset=utf-8');

$grupo = 'g2';
$rota = 'v1';

?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <title><?= htmlspecialchars($grupo) ?>/<?= htmlspecialchars($rota) ?></title>
</head>
<body>
    <h1>Exemplo — <?= htmlspecialchars($grupo) ?> / <?= htmlspecialchars($rota) ?></h1>
    <p>Entrada típica: URL que termina em <code>2.vbs</code> (regex nginx → <code>/g2/v1/index.php</code>).</p>
    <p><strong>REQUEST_URI:</strong> <?= htmlspecialchars($_SERVER['REQUEST_URI'] ?? '') ?></p>
    <p><strong>QUERY_STRING:</strong> <?= htmlspecialchars($_SERVER['QUERY_STRING'] ?? '') ?></p>
</body>
</html>
