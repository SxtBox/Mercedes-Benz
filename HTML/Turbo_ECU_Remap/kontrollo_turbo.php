<?php
header("Content-Type: application/json");

$tuning = isset($_POST['tuning']) && $_POST['tuning'] === '1';

function pasMontimitTurbo($eshteTuning) {
    if ($eshteTuning) {
        $mesazh = "Duhet kalibrim elektronik (ECU remap) për të përshtatur parametrat e turbos.\n";
    } else {
        $mesazh = "Mund të montohet direkt pa kalibrim elektronik.\n";
    }
    $mesazh .= "Por, kontrollo lidhjet, pastro linjat e vajit dhe ftohjes, dhe bëj reset kodet e gabimeve.\n";
    return $mesazh;
}

echo json_encode(["mesazh" => pasMontimitTurbo($tuning)]);
