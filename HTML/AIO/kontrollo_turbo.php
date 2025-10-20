<?php
header("Content-Type: application/json");
$tuning = isset($_POST['tuning']) && $_POST['tuning']==='1';
$mesazh = $tuning
    ? "Duhet kalibrim elektronik (ECU remap) për të përshtatur parametrat e turbos.\n"
    : "Mund të montohet direkt pa kalibrim elektronik.\n";
$mesazh .= "Por, kontrollo lidhjet, pastro linjat e vajit dhe ftohjes, dhe bëj reset kodet e gabimeve.\n";
echo json_encode(["mesazh"=>$mesazh]);
