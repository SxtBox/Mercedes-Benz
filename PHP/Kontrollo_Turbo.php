<?php
header("Content-type: application/json");
function kontrolloTurbo() {
    // 1. Verifiko cilësinë e pjesës
    $turbo = "pasigur";
    $cmimi = 150; // Euro

    if ($cmimi < 200) {
        echo "Shume e mundshme qe pjesa eshte jo origjinale dhe me cilësi të dobët.\n";
    }

    // 2. Kontrollo linjat e vajosjes dhe ftohjes
    $liniVajiPastra = false;
    $ftohjaFunksionon = false;

    if (!$liniVajiPastra || !$ftohjaFunksionon) {
        echo "Kontrollo linjat e vajit dhe sistemin e ftohjes. Një bllokim ose problem këtu mund të prishë turbon.\n";
    }

    // 3. Kontrollo instalimin
    $instalimSakt = false;
    if (!$instalimSakt) {
        echo "Kontrollo nëse turbo është instaluar saktë.\n";
    }
}

kontrolloTurbo();
?>