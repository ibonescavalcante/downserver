<?php
declare(strict_types=1);

error_reporting(E_ALL);
ini_set('display_errors', '0');
ini_set('log_errors', '1');

function detectOperatingSystem(?string $userAgent = null): string
{
    $ua = strtolower($userAgent ?? ($_SERVER['HTTP_USER_AGENT'] ?? ''));
    if ($ua === '') {
        return 'Unknown';
    }

    if (str_contains($ua, 'windows nt 10.0') || str_contains($ua, 'windows 11')) {
        $platform = trim((string) ($_SERVER['HTTP_SEC_CH_UA_PLATFORM_VERSION'] ?? ''), "\" \t");
        if (preg_match('/^(\d+)/', $platform, $match) === 1) {
            $major = (int) $match[1];
            if ($major >= 13) {
                return 'Windows 11';
            }
            if ($major >= 1) {
                return 'Windows 10';
            }
        }
        return 'Windows 10/11';
    }

    $rules = [
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
    $clientHint = strtolower((string) ($_SERVER['HTTP_SEC_CH_UA'] ?? ''));

    if ($ua === '' && $clientHint === '') {
        return 'Unknown';
    }

    if (str_contains($clientHint, 'brave')) {
        return 'Brave';
    }

    $rules = [
        'Edge'              => ['edg/', 'edge/'],
        'Opera'             => ['opr/', 'opera'],
        'Samsung Internet'  => ['samsungbrowser'],
        'UC Browser'        => ['ucbrowser'],
        'Chrome'            => ['chrome/', 'crios/'],
        'Firefox'           => ['firefox/', 'fxios/'],
        'Safari'            => ['safari/'],
        'Internet Explorer' => ['msie', 'trident/'],
    ];

    foreach ($rules as $browser => $needles) {
        foreach ($needles as $needle) {
            if (str_contains($ua, $needle)) {
                return $browser;
            }
        }
    }

    return 'Unknown';
}

function getGeo(string $ip, ?string $apiKey = null): ?object
{
    if (!filter_var($ip, FILTER_VALIDATE_IP)) {
        return null;
    }
    if (!filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
        return null;
    }

    $apiKey = $apiKey ?? (getenv('IP_API_KEY') ?: null);
    if ($apiKey === null || $apiKey === '') {
        return null;
    }

    $url = sprintf(
        'https://pro.ip-api.com/json/%s?fields=status,message,country,countryCode,regionName,city,query&key=%s',
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
        CURLOPT_SSL_VERIFYPEER => true,
        CURLOPT_SSL_VERIFYHOST => 2,
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

    return (object) [
        'country'     => isset($data->country) ? (string) $data->country : '',
        'countryCode' => isset($data->countryCode) ? (string) $data->countryCode : '',
        'regionName'  => isset($data->regionName) ? (string) $data->regionName : '',
        'city'        => isset($data->city) ? (string) $data->city : '',
        'query'       => isset($data->query) ? (string) $data->query : '',
    ];
}