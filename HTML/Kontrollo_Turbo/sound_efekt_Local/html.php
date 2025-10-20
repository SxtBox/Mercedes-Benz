<!----/>
Vendosi në të njëjtin folder:

success.mp3 → tingull pozitiv / klik i butë (p.sh. success tone)

warn.mp3 → paralajmërim (beep light warning)

error.mp3 → gabim / alert tone

Nëse s’i ke, mund të përdorë:

mixkit.co/free-sound-effects

ose freesound.org

Shkarko 3 tinguj të shkurtër MP3 dhe emërtoji:

success.mp3
warn.mp3
error.mp3
<!---->

<!DOCTYPE html>
<html lang="sq">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kontrollo Turbon</title>
<style>
    :root {
        --lime: #33ff66;
        --lime-light: #57ff85;
        --dark-bg: #0d0d0d;
        --card-bg: #1a1a1a;
        --text: #d1ffd1;
        --warn: #ffcc00;
        --ok: #33ff66;
        --err: #ff5555;
    }
    body {
        background-color: var(--dark-bg);
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
        margin-bottom: 20px;
        text-shadow: 0 0 10px #33ff6680;
    }
    form {
        background-color: var(--card-bg);
        border: 1px solid var(--lime);
        border-radius: 12px;
        padding: 25px;
        width: 320px;
        box-shadow: 0 0 15px #33ff6620;
    }
    label {
        display: block;
        margin-top: 10px;
        color: var(--text);
        font-size: 15px;
    }
    input, select, button {
        width: 100%;
        padding: 10px;
        margin-top: 6px;
        border: 1px solid var(--lime);
        border-radius: 6px;
        background-color: #0f0f0f;
        color: var(--text);
        font-size: 15px;
    }
    button {
        background-color: var(--lime);
        color: var(--dark-bg);
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 15px;
    }
    button:hover {
        background-color: var(--lime-light);
        box-shadow: 0 0 10px var(--lime);
    }
    #output {
        margin-top: 25px;
        padding: 15px;
        width: 320px;
        background-color: var(--card-bg);
        border: 1px solid var(--lime);
        border-radius: 8px;
        font-size: 14px;
        white-space: pre-wrap;
        box-shadow: 0 0 10px #33ff6620;
    }
    .message {
        opacity: 0;
        transform: translateY(10px);
        animation: fadeInUp 0.5s forwards;
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 6px;
    }
    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .icon {
        font-weight: bold;
        font-size: 18px;
    }
    .warn .icon { color: var(--warn); }
    .ok .icon { color: var(--ok); }
    .err .icon { color: var(--err); }
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

<!-- Efekte zanore lokale -->
<audio id="sound-ok" src="success.mp3" preload="auto"></audio>
<audio id="sound-warn" src="warn.mp3" preload="auto"></audio>
<audio id="sound-err" src="error.mp3" preload="auto"></audio>

<script>
document.getElementById("turboForm").addEventListener("submit", async (e) => {
    e.preventDefault();
    const formData = new FormData(e.target);
    const res = await fetch("kontrollo.php", { method: "POST", body: formData });
    const data = await res.json();

    const output = document.getElementById("output");
    output.innerHTML = "";

    data.mesazhe.forEach((msg, i) => {
        const div = document.createElement("div");
        div.className = "message";
        let icon = "⚠️";
        let type = "warn";
        let sound = document.getElementById("sound-warn");

        if (msg.toLowerCase().includes("rregull")) {
            icon = "✅";
            type = "ok";
            sound = document.getElementById("sound-ok");
        } else if (msg.toLowerCase().includes("jo")) {
            icon = "❌";
            type = "err";
            sound = document.getElementById("sound-err");
        }

        div.classList.add(type);
        div.innerHTML = `<span class="icon">${icon}</span> <span>${msg}</span>`;
        output.appendChild(div);

        // efekti me vonesë & zë
        setTimeout(() => {
            div.style.animationDelay = `${i * 0.15}s`;
            sound.currentTime = 0;
            sound.play();
        }, 150 * i);
    });
});
</script>

</body>
</html>
