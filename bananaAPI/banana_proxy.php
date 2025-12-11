<!-- AI -->

<?php
header('Content-Type: application/json; charset=utf-8');

// Ensure cURL is available
if (!function_exists('curl_init')) {
    http_response_code(500);
    echo json_encode(['error' => 'cURL extension not available on server']);
    exit;
}

// Try HTTPS first, then HTTP
$apiUrls = [
    'https://marcconrad.com/uob/banana/api.php?out=json&base64=no',
    'http://marcconrad.com/uob/banana/api.php?out=json&base64=no'
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_USERAGENT, 'LogicPuzzleGame/1.0');

$response = null;
$lastErr = '';
$lastHttp = 0;

foreach ($apiUrls as $apiUrl) {
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    $resp = curl_exec($ch);
    $err = curl_error($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if ($resp !== false && $http_code === 200) {
        $response = $resp;
        $lastHttp = $http_code;
        break;
    }

    $lastErr = $err ?: ('HTTP ' . $http_code);
    $lastHttp = $http_code;
}

curl_close($ch);

if ($response === null) {
    http_response_code(502);
    echo json_encode([
        'error' => 'Banana API unavailable',
        'details' => $lastErr,
        'http_code' => $lastHttp
    ]);
    exit;
}

// parse and validate JSON
$decoded = json_decode($response, true);
if (!is_array($decoded) || !isset($decoded['question']) || !isset($decoded['solution'])) {
    http_response_code(502);
    echo json_encode([
        'error' => 'Unexpected API response',
        'http_code' => $lastHttp,
        'response_snippet' => substr($response, 0, 1000)
    ]);
    exit;
}

// return only needed fields
echo json_encode([
    'question' => $decoded['question'],
    'solution' => $decoded['solution']
]);