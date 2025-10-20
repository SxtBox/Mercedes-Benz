<?php
/*
Si funksionon
Mercedes-Benz → fillon me A dhe ka 7+ shifra (A2710901480)

BMW → vetëm 11 shifra (11317521058)

Audi → përzierje shkronjash e numrash (06K103601N)

VW → fillon me prefikse tipike si 03L, 1K0, 5Q0, etj.
*/
header("Content-Type: application/json");

// Funksione për markat kryesore
function kontrolloMercedes($p) {
    // Format tipik: A2710901480 ose A2115000149
    return preg_match('/^A\d{7,}$/i', $p);
}

function kontrolloBMW($p) {
    // BMW: zakonisht 11 shifra, p.sh. 11317521058 ose 51718184574
    return preg_match('/^\d{11}$/', $p);
}

function kontrolloAudi($p) {
    // Audi: zakonisht 3 shkronja + 3 shifra + 3 shkronja (p.sh. 06K103601N)
    return preg_match('/^[0-9A-Z]{2,3}\d{3,4}[0-9A-Z]{1,3}$/', $p);
}

function kontrolloVW($p) {
    // VW: ngjashëm me Audi, shpesh fillon me 03L, 06A, etj.
    return preg_match('/^(03|04|06|1K|5Q|7H|8D)[0-9A-Z]{6,}$/', $p);
}

// Merr part number
$part = strtoupper(trim($_POST['partNumber'] ?? ''));

if (empty($part)) {
    echo json_encode(["marka" => "None", "mesazh" => "⚠️ Ju lutem shkruani një numër pjesë."]);
    exit;
}

// Kontrollo markat
if (kontrolloMercedes($part)) {
    echo json_encode([
        "marka" => "Mercedes-Benz",
        "mesazh" => "✅ Pjesa ka format origjinal Mercedes-Benz ($part)."
    ]);
} elseif (kontrolloBMW($part)) {
    echo json_encode([
        "marka" => "BMW",
        "mesazh" => "✅ Pjesa ka format origjinal BMW ($part)."
    ]);
} elseif (kontrolloAudi($part)) {
    echo json_encode([
        "marka" => "Audi",
        "mesazh" => "✅ Pjesa ka format të mundshëm origjinal Audi ($part)."
    ]);
} elseif (kontrolloVW($part)) {
    echo json_encode([
        "marka" => "Volkswagen",
        "mesazh" => "✅ Pjesa ka format të mundshëm origjinal Volkswagen ($part)."
    ]);
} else {
    echo json_encode([
        "marka" => "Unknown",
        "mesazh" => "❌ Nuk përputhet me formatet e zakonshme të Mercedes, BMW, Audi ose VW."
    ]);
}
?>
