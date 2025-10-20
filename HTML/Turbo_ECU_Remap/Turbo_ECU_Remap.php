<?php
header("Content-type: application/json");
function pasMontimitTurbo($eshteTuning) {
    if ($eshteTuning) {
        echo "Duhet kalibrim elektronik (ECU remap) për të përshtatur parametrat e turbos.\n";
    } else {
        echo "Mund të montohet direkt pa kalibrim elektronik.\n";
    }
    echo "Por, kontrollo lidhjet, pastro linjat e vajit dhe ftohjes, dhe bëj reset kodet e gabimeve.\n";
}
//pasMontimitTurbo(true);
pasMontimitTurbo(false); // Për zëvendësim origjinal pa tuning
?>