<?php
/*
Ky version:

Kontrollon çdo part number që fut nga forma.

Jep përgjigje në ngjyrë të gjelbër (origjinale) ose të kuqe (jo origjinale).

Ka dark-lime dizajn që përputhet me projektet e tua të mëparshme.
*/
header("Content-Type: application/json");

function eshteOrigjinale($partNumber) {
    // Format tipik i pjesëve origjinale Mercedes-Benz
    // Shembull: A2710901480 ose A2115000149
    return preg_match('/^A\d{7,}$/', trim($partNumber));
}

$partNumber = $_POST['partNumber'] ?? '';

if (empty($partNumber)) {
    echo json_encode([
        "origjinale" => false,
        "mesazh" => "Ju lutem shkruani një numër pjesë."
    ]);
    exit;
}

if (eshteOrigjinale($partNumber)) {
    echo json_encode([
        "origjinale" => true,
        "mesazh" => "✅ Pjesa me shumë gjasa është ORIGJINALE Mercedes-Benz."
    ]);
} else {
    echo json_encode([
        "origjinale" => false,
        "mesazh" => "⚠️ Pjesa mund të jetë JO ORIGJINALE ose format i gabuar."
    ]);
}
?>
