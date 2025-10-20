<!DOCTYPE html>
<html lang="sq">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kontrollo Pjesën Mercedes</title>
<style>
    :root {
        --lime: #33ff66;
        --bg-dark: #0c0c0c;
        --card: #1a1a1a;
        --text: #ccffcc;
    }
    body {
        background: var(--bg-dark);
        color: var(--text);
        font-family: "Segoe UI", sans-serif;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100vh;
        margin: 0;
    }
    h1 {
        color: var(--lime);
        margin-bottom: 20px;
        text-shadow: 0 0 10px var(--lime);
    }
    form {
        background: var(--card);
        border: 1px solid var(--lime);
        border-radius: 10px;
        padding: 25px;
        width: 320px;
        box-shadow: 0 0 10px #33ff6640;
    }
    input, button {
        width: 100%;
        padding: 10px;
        margin-top: 10px;
        border-radius: 5px;
        border: 1px solid var(--lime);
        background-color: #0f0f0f;
        color: var(--text);
        font-size: 16px;
    }
    button {
        background: var(--lime);
        color: #000;
        font-weight: bold;
        cursor: pointer;
        transition: 0.3s;
    }
    button:hover {
        box-shadow: 0 0 10px var(--lime);
    }
    #rezultat {
        margin-top: 20px;
        background: var(--card);
        border: 1px solid var(--lime);
        border-radius: 8px;
        padding: 15px;
        width: 320px;
        text-align: center;
        font-size: 15px;
        box-shadow: 0 0 10px #33ff6620;
    }
</style>
</head>
<body>

<h1>Kontrollo Pjesën Mercedes</h1>

<form id="forma">
    <input type="text" name="partNumber" value="A2710901480" placeholder="Shkruaj Part Number p.sh. A2710901480" required>
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
    out.style.color = data.origjinale ? '#33ff66' : '#ff5555';
});
</script>

</body>
</html>
