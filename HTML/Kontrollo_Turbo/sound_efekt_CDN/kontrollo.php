<?php
header("Content-Type: application/json");

function kontrolloTurbo($cmimi, $liniVajiPastra, $ftohjaFunksionon, $instalimSakt) {
    $mesazhe = [];

    // 1. Verifiko cilësinë e pjesës
    if ($cmimi < 200) {
        $mesazhe[] = "Shumë e mundshme që pjesa është jo origjinale dhe me cilësi të dobët.";
    } else {
        $mesazhe[] = "Çmimi tregon mundësi të mirë që pjesa është origjinale.";
    }

    // 2. Kontrollo linjat e vajit dhe ftohjes
    if (!$liniVajiPastra || !$ftohjaFunksionon) {
        $mesazhe[] = "Kontrollo linjat e vajit dhe sistemin e ftohjes — një bllokim këtu mund të dëmtojë turbon.";
    } else {
        $mesazhe[] = "Linjat e vajit dhe ftohja duken në rregull.";
    }

    // 3. Kontrollo instalimin
    if (!$instalimSakt) {
        $mesazhe[] = "Kontrollo nëse turbo është instaluar saktë.";
    } else {
        $mesazhe[] = "Instalimi është në rregull.";
    }

    return $mesazhe;
}

// Lexo inputet me siguri
$cmimi = floatval($_POST['cmimi'] ?? 0);
$liniVajiPastra = intval($_POST['liniVajiPastra'] ?? 0);
$ftohjaFunksionon = intval($_POST['ftohjaFunksionon'] ?? 0);
$instalimSakt = intval($_POST['instalimSakt'] ?? 0);

$rezultate = kontrolloTurbo($cmimi, $liniVajiPastra, $ftohjaFunksionon, $instalimSakt);

echo json_encode(["mesazhe" => $rezultate]);
?>
