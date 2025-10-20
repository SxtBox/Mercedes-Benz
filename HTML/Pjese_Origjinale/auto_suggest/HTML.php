<!DOCTYPE html>
<html lang="sq">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Auto Kontroll Pjesësh</title>
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
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        margin: 0;
    }
    h1 {
        color: var(--lime);
        text-shadow: 0 0 10px var(--lime);
    }
    form {
        background-color: var(--card);
        border: 1px solid var(--lime);
        border-radius: 10px;
        padding: 25px;
        width: 320px;
        margin-top: 20px;
        box-shadow: 0 0 15px #33ff6620;
    }
    input, button {
        width: 100%;
        padding: 10px;
        margin-top: 10px;
        border: 1px solid var(--lime);
        border-radius: 6px;
        background-color: #0f0f0f;
        color: var(--text);
        font-size: 16px;
        transition: all 0.2s ease-in-out;
    }
    button {
        background-color: var(--lime);
        color: #000;
        font-weight: bold;
        cursor: pointer;
        transition: 0.3s;
    }
    button:hover {
        background-color: #55ff88;
        box-shadow: 0 0 10px var(--lime);
    }
    #suggestion {
        margin-top: 8px;
        font-size: 13px;
        opacity: 0.9;
        text-align: left;
        padding-left: 4px;
    }
    #rezultat {
        margin-top: 25px;
        background: var(--card);
        border: 1px solid var(--lime);
        border-radius: 10px;
        padding: 15px;
        width: 320px;
        text-align: center;
        font-size: 15px;
        box-shadow: 0 0 10px #33ff6620;
    }
</style>
</head>
<body>

<h1>Kontrollo Pjesën</h1>

<form id="forma">
    <input type="text" id="partInput" name="partNumber" placeholder="Shkruaj Part Number p.sh. A2710901480" required>
    <div id="suggestion">💡 Shkruani numrin e pjesës...</div>
    <button type="submit">Kontrollo</button>
</form>

<div id="rezultat">Rezultati do shfaqet këtu...</div>

<script>
// Funksioni për të zbuluar markën sipas pattern-it
function detectBrand(part) {
    part = part.toUpperCase().trim();
    if (/^A\d{7,}$/.test(part)) return { brand: "Mercedes-Benz", color: "var(--benz)" };
    if (/^\d{11}$/.test(part)) return { brand: "BMW", color: "var(--bmw)" };
    if (/^[0-9A-Z]{2,3}\d{3,4}[0-9A-Z]{1,3}$/.test(part)) return { brand: "Audi", color: "var(--audi)" };
    if (/^(03|04|06|1K|5Q|7H|8D)[0-9A-Z]{6,}$/.test(part)) return { brand: "Volkswagen", color: "var(--vw)" };
    return { brand: "E Panjohur", color: "var(--warn)" };
}

const input = document.getElementById('partInput');
const suggestion = document.getElementById('suggestion');
const rezultat = document.getElementById('rezultat');

input.addEventListener('input', () => {
    const val = input.value;
    if (!val) {
        input.style.borderColor = 'var(--lime)';
        suggestion.textContent = "💡 Shkruani numrin e pjesës...";
        suggestion.style.color = 'var(--text)';
        return;
    }
    const det = detectBrand(val);
    input.style.borderColor = `var(${det.color})`;
    suggestion.textContent = `🔎 Duket si pjesë ${det.brand}`;
    suggestion.style.color = `var(${det.color})`;
});

// Dergo kërkesën tek PHP
document.getElementById('forma').addEventListener('submit', async e => {
    e.preventDefault();
    const fd = new FormData(e.target);
    rezultat.textContent = "⏳ Duke kontrolluar...";
    const res = await fetch('kontrollo_pjese.php', { method: 'POST', body: fd });
    const data = await res.json();
    rezultat.textContent = data.mesazh;

    switch (data.marka) {
        case 'Mercedes-Benz': rezultat.style.color = 'var(--benz)'; break;
        case 'BMW': rezultat.style.color = 'var(--bmw)'; break;
        case 'Audi': rezultat.style.color = 'var(--audi)'; break;
        case 'Volkswagen': rezultat.style.color = 'var(--vw)'; break;
        default: rezultat.style.color = 'var(--warn)';
    }
});
</script>

</body>
</html>
