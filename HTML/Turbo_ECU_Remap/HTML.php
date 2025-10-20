<!----/>
Si funksionon:
User shënon checkbox nëse turbo është me tuning.

Kur klikohet “Kontrollo”, form dërgon POST tek PHP.

PHP kthen mesazh JSON me këshillat për pas montimit.

Rezultati shfaqet live në div #rezultat në HTML.
<!---->

<!DOCTYPE html>
<html lang="sq">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kontroll Turbo</title>
<style>
:root {
    --lime: #33ff66;
    --bg: #0c0c0c;
    --card: #1a1a1a;
    --text: #d1ffd1;
    --warn: #ffcc00;
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
input[type="checkbox"] {
    margin-right: 8px;
}
button {
    width: 100%;
    padding: 10px;
    margin-top: 10px;
    background-color: var(--lime);
    color: #000;
    font-weight: bold;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: 0.3s;
}
button:hover {
    background-color: #55ff88;
    box-shadow: 0 0 10px var(--lime);
}
#rezultat {
    margin-top: 20px;
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

<h1>Kontroll Pas Montimit Turbo</h1>

<form id="forma">
    <label>
        <input type="checkbox" id="tuningCheck">
        Është Turbo me Tuning (remap ECU)
    </label>
    <button type="submit">Kontrollo</button>
</form>

<div id="rezultat">Rezultati do shfaqet këtu...</div>

<script>
document.getElementById('forma').addEventListener('submit', async e => {
    e.preventDefault();
    const tuning = document.getElementById('tuningCheck').checked;

    // Thjesht fetch tek PHP
    const formData = new FormData();
    formData.append('tuning', tuning ? '1' : '0');

    const res = await fetch('kontrollo_turbo.php', { method: 'POST', body: formData });
    const data = await res.json();

    const out = document.getElementById('rezultat');
    out.textContent = data.mesazh;
});
</script>

</body>
</html>
