<!DOCTYPE html>
<html lang="sq">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kontrollo Pjesën e Automjetit</title>
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
    <input type="text" name="partNumber" placeholder="Shkruaj Part Number p.sh. A2710901480" required>
    <button type="submit">Kontrollo</button>
</form>

<div id="rezultat">Rezultati do shfaqet këtu...</div>

<script>
document.getElementById('forma').addEventListener('submit', async e => {
    e.preventDefault();
    const fd = new FormData(e.target);
    const res = await fetch('kontrollo_pjese.php', { method: 'POST', body: fd });
    const data = await res.json();

    const out = document.getElementById('rezultat');
    out.textContent = data.mesazh;

    switch (data.marka) {
        case 'Mercedes-Benz': out.style.color = 'var(--benz)'; break;
        case 'BMW': out.style.color = 'var(--bmw)'; break;
        case 'Audi': out.style.color = 'var(--audi)'; break;
        case 'Volkswagen': out.style.color = 'var(--vw)'; break;
        case 'Unknown': out.style.color = 'var(--warn)'; break;
        default: out.style.color = 'var(--err)';
    }
});
</script>

</body>
</html>
