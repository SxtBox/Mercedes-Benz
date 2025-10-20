<!----/>
Si funksionon:

Shkruan numrin e pjesës → sugjeron markën + shfaq logo.

Submit pjesë → PHP kontrollon origjinalitetin dhe tregon mesazh JSON.

Checkbox turbo → kontrollon tuning ose jo dhe shfaq këshillat pas montimit.
<!---->
<!DOCTYPE html>
<html lang="sq">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kontrollo Pjesë & Turbo</title>
<style>
:root {
    --lime: #33ff66;
    --bg: #0c0c0c;
    --card: #1a1a1a;
    --text: #d1ffd1;
    --benz: #00d2ff;
    --bmw: #0077ff;
    --audi: #ff0033;
    --vw: #00cc99;
    --warn: #ffcc00;
    --err: #ff4444;
}
body {
    background-color: var(--bg);
    color: var(--text);
    font-family: "Segoe UI", sans-serif;
    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:flex-start;
    min-height:100vh;
    margin:0;
    padding:20px 0;
}
h1 {color:var(--lime); text-shadow:0 0 10px var(--lime);}
form {
    background-color: var(--card);
    border:1px solid var(--lime);
    border-radius:10px;
    padding:25px;
    width:350px;
    margin-top:20px;
    box-shadow:0 0 15px #33ff6620;
    position:relative;
}
.input-wrapper {
    position:relative;
}
input[type="text"] {
    width:100%;
    padding:10px;
    border-radius:6px;
    border:1px solid var(--lime);
    background:#0f0f0f;
    color: var(--text);
    font-size:16px;
    padding-right:40px;
    transition: all 0.2s ease-in-out;
}
.logo {
    position:absolute;
    right:10px;
    top:50%;
    transform:translateY(-50%);
    width:30px;
    height:30px;
    display:none;
    transition: transform 0.2s ease;
}
button {
    width:100%;
    padding:10px;
    margin-top:10px;
    background-color: var(--lime);
    color:#000;
    font-weight:bold;
    border:none;
    border-radius:6px;
    cursor:pointer;
    transition:0.3s;
}
button:hover {background-color:#55ff88;box-shadow:0 0 10px var(--lime);}
#suggestion {margin-top:8px;font-size:13px;opacity:0.9;text-align:left;padding-left:4px;}
#rezultat {margin-top:15px;background:var(--card);border:1px solid var(--lime);border-radius:10px;padding:15px;width:350px;text-align:left;font-size:15px;box-shadow:0 0 10px #33ff6620;}
</style>
</head>
<body>

<h1>Kontrollo Pjesë & Turbo</h1>

<!-- Forma për pjesë -->
<form id="formaPjese">
    <div class="input-wrapper">
        <input type="text" id="partInput" name="partNumber" placeholder="Shkruaj Part Number p.sh. A2710901480">
        <img id="logoPjese" class="logo" src="" alt="Logo">
    </div>
    <div id="suggestion">💡 Shkruani numrin e pjesës...</div>
    <button type="submit">Kontrollo Pjesën</button>
</form>

<!-- Forma për turbo -->
<form id="formaTurbo" style="margin-top:30px;">
    <label>
        <input type="checkbox" id="tuningCheck"> Është Turbo me Tuning (remap ECU)
    </label>
    <button type="submit">Kontrollo Turbo</button>
</form>

<div id="rezultat"></div>

<script>
// Funksioni për të detektuar markën
function detectBrand(part){
    part = part.toUpperCase().trim();
    if(/^A\d{7,}$/.test(part)) return { brand:"Mercedes-Benz", color:"var(--benz)", logo:"logos/mercedes.png" };
    if(/^\d{11}$/.test(part)) return { brand:"BMW", color:"var(--bmw)", logo:"logos/bmw.png" };
    if(/^[0-9A-Z]{2,3}\d{3,4}[0-9A-Z]{1,3}$/.test(part)) return { brand:"Audi", color:"var(--audi)", logo:"logos/audi.png" };
    if(/^(03|04|06|1K|5Q|7H|8D)[0-9A-Z]{6,}$/.test(part)) return { brand:"Volkswagen", color:"var(--vw)", logo:"logos/vw.png" };
    return { brand:"E Panjohur", color:"var(--warn)", logo:"logos/error.png" };
}

// Pjesa JS
const input = document.getElementById('partInput');
const suggestion = document.getElementById('suggestion');
const logoPjese = document.getElementById('logoPjese');
const rezultat = document.getElementById('rezultat');

input.addEventListener('input',()=>{
    const val = input.value;
    if(!val){ input.style.borderColor='var(--lime)'; suggestion.textContent="💡 Shkruani numrin e pjesës..."; suggestion.style.color='var(--text)'; logoPjese.style.display='none'; return;}
    const det = detectBrand(val);
    input.style.borderColor = det.color;
    suggestion.textContent = `🔎 Duket si pjesë ${det.brand}`;
    suggestion.style.color = det.color;
    logoPjese.src = det.logo;
    logoPjese.style.display='block';
});

// Submit pjesë
document.getElementById('formaPjese').addEventListener('submit', async e=>{
    e.preventDefault();
    const fd = new FormData(e.target);
    rezultat.textContent = "⏳ Duke kontrolluar pjesën...";
    const res = await fetch('kontrollo_pjese.php', {method:'POST', body:fd});
    const data = await res.json();
    rezultat.innerHTML = `<strong>Pjesë:</strong> ${data.mesazh}`;
});

// Submit turbo
document.getElementById('formaTurbo').addEventListener('submit', async e=>{
    e.preventDefault();
    const tuning = document.getElementById('tuningCheck').checked;
    const fd = new FormData();
    fd.append('tuning', tuning ? '1' : '0');
    rezultat.textContent = "⏳ Duke kontrolluar turbon...";
    const res = await fetch('kontrollo_turbo.php', {method:'POST', body:fd});
    const data = await res.json();
    rezultat.innerHTML += `<br><strong>Turbo:</strong> ${data.mesazh}`;
});
</script>

</body>
</html>
