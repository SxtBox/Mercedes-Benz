<?php
header("Content-Type: application/json");
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["mesazh" => "Metoda e kërkesës nuk lejohet."], JSON_UNESCAPED_UNICODE);
    exit;
}

$tuning = isset($_POST['tuning']) && $_POST['tuning'] === '1';
$mesazh = $tuning
    ? "Duhet kalibrim elektronik (ECU remap) për të përshtatur parametrat e turbos."
    : "Mund të montohet direkt pa kalibrim elektronik.";
$mesazh .= " Por, kontrollo lidhjet, pastro linjat e vajit dhe ftohjes, dhe bëj reset kodet e gabimeve.";
echo json_encode(["mesazh" => $mesazh], JSON_UNESCAPED_UNICODE);
