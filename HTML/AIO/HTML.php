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
    --lime: #b7ff00;
    --lime-soft: #70ff4d;
    --bg: #070b08;
    --card: rgba(13, 24, 14, 0.92);
    --card-light: rgba(22, 38, 21, 0.96);
    --text: #e8ffe0;
    --muted: #8eaa8a;
    --line: rgba(183, 255, 0, 0.28);
    --benz: #70ff4d;
    --bmw: #55c7ff;
    --audi: #ff6685;
    --vw: #62e6b0;
    --warn: #ffd166;
}
* { box-sizing: border-box; }
body {
    background: radial-gradient(circle at 10% 0%, rgba(183,255,0,.12), transparent 28rem),
        radial-gradient(circle at 90% 100%, rgba(53,255,115,.08), transparent 30rem), var(--bg);
    color: var(--text);
    font-family: "Segoe UI", system-ui, sans-serif;
    display: flex;
    flex-direction: column;
    align-items: center;
    min-height: 100vh;
    margin: 0;
    padding: 28px 18px 42px;
}
body::before {
    content: "";
    position: fixed;
    inset: 0;
    pointer-events: none;
    opacity: .16;
    background-image: linear-gradient(rgba(183,255,0,.06) 1px, transparent 1px),
        linear-gradient(90deg, rgba(183,255,0,.06) 1px, transparent 1px);
    background-size: 34px 34px;
    mask-image: linear-gradient(to bottom, black, transparent 75%);
}
.shell { width: min(980px, 100%); position: relative; z-index: 1; }
.topbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 28px;
}
.eyebrow {
    color: var(--lime);
    font-size: 12px;
    font-weight: 700;
    letter-spacing: .2em;
    text-transform: uppercase;
}
h1 {
    color: var(--text);
    font-size: clamp(30px, 5vw, 48px);
    line-height: 1;
    margin: 8px 0 0;
    text-shadow: 0 0 18px rgba(183,255,0,.3);
}
.status {
    border: 1px solid var(--line);
    border-radius: 999px;
    color: var(--lime-soft);
    font-size: 12px;
    padding: 9px 14px;
    white-space: nowrap;
}
.status::before {
    content: "";
    display: inline-block;
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: var(--lime);
    box-shadow: 0 0 10px var(--lime);
    margin-right: 8px;
}
.panel-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 18px; }
form, #rezultat {
    background: linear-gradient(145deg, var(--card-light), var(--card));
    border: 1px solid var(--line);
    border-radius: 18px;
    box-shadow: 0 14px 50px rgba(0,0,0,.32), 0 0 25px rgba(183,255,0,.06);
}
form {
    padding: 24px;
    width: auto;
    margin-top: 0;
    position: relative;
    overflow: hidden;
}
form::after {
    content: "";
    position: absolute;
    width: 120px;
    height: 120px;
    right: -45px;
    top: -45px;
    border: 1px solid rgba(183,255,0,.18);
    border-radius: 50%;
}
.card-label {
    color: var(--lime);
    font-size: 12px;
    font-weight: 700;
    letter-spacing: .12em;
    text-transform: uppercase;
}
.card-title { font-size: 22px; font-weight: 700; margin: 8px 0 6px; }
.card-copy { color: var(--muted); font-size: 14px; line-height: 1.5; margin: 0 0 20px; }
.input-wrapper { position: relative; }
input[type="text"] {
    width: 100%;
    padding: 13px 48px 13px 14px;
    border-radius: 10px;
    border: 1px solid var(--line);
    background: rgba(0,0,0,.3);
    color: var(--text);
    font-size: 15px;
    outline: none;
    transition: .2s ease;
}
input[type="text"]:focus {
    border-color: var(--lime);
    box-shadow: 0 0 0 3px rgba(183,255,0,.12), 0 0 18px rgba(183,255,0,.14);
}
.logo { position: absolute; right: 12px; top: 50%; transform: translateY(-50%); width: 27px; height: 27px; object-fit: contain; }
#suggestion { color: var(--muted); font-size: 13px; min-height: 20px; padding: 8px 2px 0; }
button {
    width: 100%;
    padding: 13px;
    margin-top: 16px;
    background: var(--lime);
    color: #071006;
    font-weight: 800;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    transition: .2s ease;
}
button:hover { background: #d0ff57; box-shadow: 0 0 22px rgba(183,255,0,.35); transform: translateY(-1px); }
.tuning-box { display: flex; align-items: flex-start; gap: 12px; color: var(--text); line-height: 1.45; }
input[type="checkbox"] { accent-color: var(--lime); margin: 3px 0 0; }
#rezultat {
    color: var(--text);
    font-size: 15px;
    line-height: 1.6;
    margin-top: 18px;
    min-height: 62px;
    padding: 16px 20px;
    width: auto;
}
@media (max-width: 680px) {
    body { padding: 20px 14px 30px; }
    .topbar { align-items: flex-start; flex-direction: column; gap: 14px; }
    .panel-grid { grid-template-columns: 1fr; }
}
</style>
</head>
<body>

<main class="shell">
<header class="topbar">
    <div>
        <div class="eyebrow">Mercedes-Benz / Workshop tools</div>
        <h1>Kontrollo Pjesë & Turbo</h1>
    </div>
    <div class="status">SISTEMI AKTIV</div>
</header>

<section class="panel-grid">
<form id="formaPjese" aria-labelledby="parts-title">
    <div class="card-label">01 / Identifikim</div>
    <div class="card-title" id="parts-title">Kontrollo pjesën</div>
    <p class="card-copy">Analizo formatin e numrit dhe identifiko markën e mundshme.</p>
    <div class="input-wrapper">
        <input type="text" id="partInput" name="partNumber" maxlength="32" autocomplete="off" placeholder="p.sh. A2710901480" aria-label="Numri i pjesës">
        <img id="logoPjese" class="logo" src="" alt="Logo">
    </div>
    <div id="suggestion">💡 Shkruani numrin e pjesës...</div>
    <button type="submit">Kontrollo Pjesën</button>
</form>

<form id="formaTurbo" aria-labelledby="turbo-title">
    <div class="card-label">02 / Diagnostikim</div>
    <div class="card-title" id="turbo-title">Kontrollo turbon</div>
    <p class="card-copy">Merr udhëzime pas montimit për konfigurimin standard ose tuning.</p>
    <label class="tuning-box">
        <input type="checkbox" id="tuningCheck"> Është Turbo me Tuning (remap ECU)
    </label>
    <button type="submit">Kontrollo Turbo</button>
</form>
</section>

<div id="rezultat"></div>
</main>

<script>
// Funksioni për të detektuar markën
function detectBrand(part){
    part = part.toUpperCase().trim();
    if(/^A\d{7,}$/.test(part)) return { brand:"Mercedes-Benz", color:"var(--benz)", logo:"logos/mercedes.png" };
    if(/^\d{11}$/.test(part)) return { brand:"BMW", color:"var(--bmw)", logo:"logos/bmw.png" };
    if(/^[0-9A-Z]{2,3}\d{3,4}[0-9A-Z]{1,3}$/.test(part)) return { brand:"Audi", color:"var(--audi)", logo:"logos/audi.png" };
    if(/^(03|04|06|1K|5Q|7H|8D)[0-9A-Z]{6,}$/.test(part)) return { brand:"Volkswagen", color:"var(--vw)", logo:"logos/vw.png" };
    return { brand:"E Panjohur", color:"var(--warn)", logo:"" };
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
    if (det.logo) {
        logoPjese.src = det.logo;
        logoPjese.style.display='block';
    } else {
        logoPjese.removeAttribute('src');
        logoPjese.style.display='none';
    }
});

// Submit pjesë
document.getElementById('formaPjese').addEventListener('submit', async e=>{
    e.preventDefault();
    const fd = new FormData(e.target);
    rezultat.textContent = "⏳ Duke kontrolluar pjesën...";
    try {
        const res = await fetch('kontrollo_pjese.php', {method:'POST', body:fd});
        const data = await res.json();
        if (!res.ok) throw new Error(data.mesazh || 'Kërkesa dështoi.');
        rezultat.textContent = `Pjesë: ${data.mesazh}`;
    } catch (error) {
        rezultat.textContent = `Pjesë: ${error.message}`;
    }
});

// Submit turbo
document.getElementById('formaTurbo').addEventListener('submit', async e=>{
    e.preventDefault();
    const tuning = document.getElementById('tuningCheck').checked;
    const fd = new FormData();
    fd.append('tuning', tuning ? '1' : '0');
    rezultat.textContent = "⏳ Duke kontrolluar turbon...";
    try {
        const res = await fetch('kontrollo_turbo.php', {method:'POST', body:fd});
        const data = await res.json();
        if (!res.ok) throw new Error(data.mesazh || 'Kërkesa dështoi.');
        rezultat.textContent = `Turbo: ${data.mesazh}`;
    } catch (error) {
        rezultat.textContent = `Turbo: ${error.message}`;
    }
});
</script>

</body>
</html>
