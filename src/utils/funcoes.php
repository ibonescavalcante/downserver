<?php

//GERA STTRING RANDOMICA
function GeraStringRandomica($size)
{
    $basic = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $basic2 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $return = $basic[rand(0, strlen($basic) - 1)];
    $size = rand($size, $size + 4);
    for ($count = 0; $size > $count; $count++) {
        $return .= $basic2[rand(0, strlen($basic2) - 1)];
    }
    return $return;
}
//CRIA ARQUIVO ZIP COM ARQUIVO HTA DENTRO (ficheiro extra em $sourceFile é opcional)
function GeraArquivoZipParaDownload($sourceFile, $htaContent, $destinationZip, $prefixoNomeHTA)
{
    if (!extension_loaded('zip')) {
        return false;
    }
    $destDir = dirname($destinationZip);
    $canWriteDest = true;
    if (!is_dir($destDir)) {
        if (!@mkdir($destDir, 0775, true)) {
            $canWriteDest = false;
        } else {
            @chmod($destDir, 0775); // umask pode ter cortado o modo
        }
    }
    if ($canWriteDest && !is_writable($destDir)) {
        // pasta existe mas sem escrita: tentar corrigir (pode falhar no bind-mount)
        @chmod($destDir, 0777);
        $canWriteDest = is_writable($destDir);
    }
    $nomeBase = preg_replace('/[^a-zA-Z0-9._-]+/', '_', (string) $prefixoNomeHTA);
    $nomeBase = trim($nomeBase, '._-') ?: 'documento';
    $nomeHTA = $nomeBase . '.hta';
    $tmpZip = rtrim(sys_get_temp_dir(), DIRECTORY_SEPARATOR)
        . DIRECTORY_SEPARATOR . 'hta_' . bin2hex(random_bytes(8)) . '.zip';
    $zip = new ZipArchive();
    if ($zip->open($tmpZip, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
        return false;
    }
    if ($sourceFile !== null && $sourceFile !== '' && is_string($sourceFile) && file_exists($sourceFile)) {
        $zip->addFile($sourceFile, basename($sourceFile));
    }
    if (!$zip->addFromString($nomeHTA, $htaContent)) {
        $zip->close();
        @unlink($tmpZip);
        return false;
    }
    if (!$zip->close()) {
        @unlink($tmpZip);
        return false;
    }
    // Destino gravável: move/copia para filex
    if ($canWriteDest) {
        if (!@rename($tmpZip, $destinationZip)) {
            if (!@copy($tmpZip, $destinationZip)) {
                @unlink($tmpZip);
                return false;
            }
            @unlink($tmpZip);
        }
        return is_readable($destinationZip) ? $destinationZip : false;
    }
    // Fallback: devolve o ZIP em /tmp (sempre gravável no container)
    return is_readable($tmpZip) ? $tmpZip : false;
}
//GERA NOMES DE VARIAVEIS RANDOMICAS EM ARRAY
function  GeraArrayNomesVariaveis($qt)
{
    $sNomeVar = "";
    $wlista = array();

    for ($i = 0; $i <= $qt; $i++) {
        do {
            $bNovo = true;
            $sNomeVar = GeraStringRandomica(2) . rand(1, 99);

            for ($i2 = 0; $i2 < count($wlista); $i2++) {
                if ($wlista[$i2] == $sNomeVar) {
                    $bNovo = false;
                    break;
                }
            }
        } while ($bNovo = false);

        $wlista[count($wlista)] = $sNomeVar;
    }

    return $wlista;
}
