<?php
header("Content-Type: application/json");
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["mesazh" => "Metoda e kërkesës nuk lejohet."], JSON_UNESCAPED_UNICODE);
    exit;
}

function kontrolloMercedes($p){ return preg_match('/^A\d{7,}$/i',$p); }
function kontrolloBMW($p){ return preg_match('/^\d{11}$/',$p); }
function kontrolloAudi($p){ return preg_match('/^[0-9A-Z]{2,3}\d{3,4}[0-9A-Z]{1,3}$/',$p); }
function kontrolloVW($p){ return preg_match('/^(03|04|06|1K|5Q|7H|8D)[0-9A-Z]{6,}$/',$p); }

$part = strtoupper(trim($_POST['partNumber'] ?? ''));
if ($part === '' || strlen($part) > 32 || !preg_match('/^[0-9A-Z-]+$/', $part)) {
    http_response_code(400);
    echo json_encode(["mesazh" => "⚠️ Numri i pjesës nuk është i vlefshëm."], JSON_UNESCAPED_UNICODE);
    exit;
}

$mesazh = "❌ Nuk përputhet me formatet e zakonshme të Mercedes, BMW, Audi ose VW.";
if (kontrolloMercedes($part)) {
    $mesazh = "✅ Pjesa ka format origjinal Mercedes-Benz ($part).";
} elseif (kontrolloBMW($part)) {
    $mesazh = "✅ Pjesa ka format origjinal BMW ($part).";
} elseif (kontrolloAudi($part)) {
    $mesazh = "✅ Pjesa ka format të mundshëm origjinal Audi ($part).";
} elseif (kontrolloVW($part)) {
    $mesazh = "✅ Pjesa ka format të mundshëm origjinal Volkswagen ($part).";
}

echo json_encode(["mesazh" => $mesazh], JSON_UNESCAPED_UNICODE);
