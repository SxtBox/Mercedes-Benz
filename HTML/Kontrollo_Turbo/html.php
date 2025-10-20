<!DOCTYPE html>
<html lang="sq">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kontrollo Turbon</title>
<style>
    body {
        background-color: #0d0d0d;
        color: #d1ffd1;
        font-family: "Segoe UI", sans-serif;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        margin: 0;
    }
    h1 {
        color: #8fff8f;
        margin-bottom: 20px;
    }
    form {
        background-color: #1a1a1a;
        border: 1px solid #33ff66;
        border-radius: 12px;
        padding: 25px;
        width: 320px;
        box-shadow: 0 0 15px #33ff6680;
    }
    label {
        display: block;
        margin-top: 10px;
        color: #c0ffc0;
    }
    input, select, button {
        width: 100%;
        padding: 10px;
        margin-top: 6px;
        border: 1px solid #33ff66;
        border-radius: 6px;
        background-color: #0f0f0f;
        color: #d1ffd1;
        font-size: 15px;
    }
    button {
        background-color: #33ff66;
        color: #0d0d0d;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    button:hover {
        background-color: #57ff85;
    }
    #output {
        margin-top: 20px;
        padding: 15px;
        width: 320px;
        background-color: #111;
        border: 1px solid #33ff66;
        border-radius: 8px;
        font-size: 14px;
        white-space: pre-wrap;
    }
</style>
</head>
<body>

<h1>Kontrollo Turbon</h1>

<form id="turboForm">
    <label>Çmimi i pjesës (€):</label>
    <input type="number" name="cmimi" placeholder="p.sh. 150" required>

    <label>Linjat e vajit të pastra?</label>
    <select name="liniVajiPastra">
        <option value="1">Po</option>
        <option value="0">Jo</option>
    </select>

    <label>Sistemi i ftohjes funksionon?</label>
    <select name="ftohjaFunksionon">
        <option value="1">Po</option>
        <option value="0">Jo</option>
    </select>

    <label>Instalimi i bërë saktë?</label>
    <select name="instalimSakt">
        <option value="1">Po</option>
        <option value="0">Jo</option>
    </select>

    <button type="submit">Kontrollo</button>
</form>

<div id="output">Rezultatet do shfaqen këtu...</div>

<script>
document.getElementById("turboForm").addEventListener("submit", async (e) => {
    e.preventDefault();
    const formData = new FormData(e.target);
    const res = await fetch("kontrollo.php", {
        method: "POST",
        body: formData
    });
    const data = await res.json();
    document.getElementById("output").textContent = data.mesazhe.join("\n");
});
</script>

</body>
</html>
