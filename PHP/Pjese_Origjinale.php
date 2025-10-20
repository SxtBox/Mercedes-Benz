<?php
header("Content-type: application/json");
function eshteOrigjinale($partNumber) {
    // Pjesët origjinale Mercedes zakonisht fillojnë me 'A' dhe kanë format specifik
	// https://rubular.com/r/4Lbd16EmCIVumA
    if (preg_match('/^A\d{7,}$/', $partNumber)) {
        return true;
    }
    return false;
}

// Shembull përdorimi
//$partNumber = "A2710901480";
$partNumber = "A2115000149";

if (eshteOrigjinale($partNumber)) {
    echo "Pjesa me shumë gjasa është ORIGJINALE Mercedes-Benz.\n";
} else {
    echo "Pjesa Mund të Jetë jo Origjinale.\n";
}
?>