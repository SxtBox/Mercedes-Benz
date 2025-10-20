<?php
header("Content-type: application/json");

function pasMontimitTurbo($eshteTuning) {
    if ($eshteTuning) {
        $mesazh = "Duhet kalibrim elektronik (ECU remap) për të përshtatur parametrat e turbos.\n";
    } else {
        $mesazh = "Mund të montohet direkt pa kalibrim elektronik.\n";
    }

    $mesazh .= "Por, kontrollo lidhjet, pastro linjat e vajit dhe ftohjes, dhe bëj reset kodet e gabimeve.\n";

    // Kthe rezultatin si JSON
    echo json_encode(["mesazh" => $mesazh]);
}

// Shembull përdorimi
pasMontimitTurbo(false); // Për zëvendësim origjinal pa tuning
