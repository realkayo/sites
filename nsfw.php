<?php
// Configurações do site
$siteTitle = "Kay's Space";
$displayName = "Kay";
$username = "@_dekayy_";
$bio = "sou tão foda que até a depressão ta me querendo";
$profilePic = "https://cdn.discordapp.com/attachments/1134407820847087648/1138896300683821086/Captura_de_ecra_2023-08-09_023036.png";
$buttonText = "Ver packs +18";

// Contador de cliques (simulado - em produção use banco de dados)
session_start();
if (!isset($_SESSION['clicks'])) {
    $_SESSION['clicks'] = 0;
}
if (isset($_POST['click'])) {
    $_SESSION['clicks']++;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo $profilePic; ?>">
    <title><?php echo $siteTitle; ?></title>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            cursor: url('https://cdn.discordapp.com/attachments/1134407820847087648/1138866870607425746/latest.png'), auto;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
            background-size: 50px 50px;
            animation: moveBackground 20s linear infinite;
        }

        @keyframes moveBackground {
            0% { transform: translate(0, 0); }
            100% { transform: translate(50px, 50px); }
        }

        .container {
            position: relative;
            z-index: 1;
        }

        .discord-card {
            background: rgba(40, 41, 44, 0.95);
            backdrop-filter: blur(10px);
            color: #ffffff;
            padding: 30px;
            border-radius: 20px;
            width: 350px;
            text-align: center;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            position: fixed;
            bottom: 30px;
            right: 30px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .discord-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 70px rgba(0, 0, 0, 0.4);
        }

        .profile-picture {
            border-radius: 50%;
            width: 120px;
            height: 120px;
            margin-bottom: 15px;
            border: 4px solid #667eea;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
            transition: transform 0.3s ease;
        }

        .profile-picture:hover {
            transform: scale(1.05) rotate(5deg);
        }

        .display-name {
            font-size: 28px;
            font-weight: bold;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 5px;
        }

        .username {
            font-size: 16px;
            color: #b3bcdf;
            margin-bottom: 15px;
        }

        .bio {
            font-size: 14px;
            line-height: 1.6;
            color: #dcddde;
            font-style: italic;
        }

        #magicButton {
            padding: 18px 40px;
            font-size: 18px;
            font-weight: bold;
            border-radius: 50px;
            border: none;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            cursor: pointer;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        #magicButton::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        #magicButton:hover::before {
            width: 300px;
            height: 300px;
        }

        #magicButton:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.6);
        }

        #magicButton:active {
            transform: translateY(-1px);
        }

        #catContainer {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            z-index: 9999;
            transition: all 2s linear;
        }

        #catImage {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 10%;
            height: auto;
            filter: drop-shadow(0 0 30px rgba(255, 255, 255, 0.8));
            transition: transform 1s ease-in-out;
        }

        #confettiCanvas {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            pointer-events: none;
            z-index: 9998;
        }

        #tacoContainer {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 9997;
        }

        .tacoConfetti {
            position: absolute;
            width: 40px;
            height: auto;
            filter: drop-shadow(0 0 10px rgba(255, 255, 255, 0.5));
            animation: rotate 10s linear infinite, fall linear 5s;
        }

        .cursorPersonalizado {
            position: fixed;
            pointer-events: none;
            width: 100px;
            height: 100px;
            background-image: url('https://cdn.discordapp.com/attachments/1134407820847087648/1138866870607425746/latest.png');
            background-size: cover;
            z-index: 10000;
            transform: translate(-50%, -50%);
            filter: drop-shadow(0 0 10px rgba(255, 255, 255, 0.8));
        }

        @keyframes rotate {
            0% { transform: translate(-50%, -50%) rotate(0deg); }
            100% { transform: translate(-50%, -50%) rotate(360deg); }
        }

        @keyframes fall {
            0% { transform: translateY(-100%); opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { transform: translateY(100vh); opacity: 0; }
        }

        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(35, 35, 35, 0.5);
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 4px;
        }

        .stats {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 12px;
            color: #b3bcdf;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="discord-card" id="discordCard">
            <img class="profile-picture" src="<?php echo $profilePic; ?>" alt="Foto de Perfil">
            <div class="display-name"><?php echo $displayName; ?></div>
            <div class="username"><?php echo $username; ?></div>
            <div class="bio"><?php echo $bio; ?></div>
            <div class="stats">
                Cliques totais: <strong><?php echo $_SESSION['clicks']; ?></strong>
            </div>
        </div>
        
        <form method="POST" id="buttonForm" style="display: inline;">
            <input type="hidden" name="click" value="1">
            <button type="submit" id="magicButton"><?php echo $buttonText; ?></button>
        </form>
    </div>

    <div id="catContainer">
        <img id="catImage" src="https://cdn.discordapp.com/attachments/1134407820847087648/1138863839555891341/Captura_de_ecra_2023-08-09_023036-removebg-preview.png" alt="Gato">
    </div>
    <div id="tacoContainer"></div>
    <canvas id="confettiCanvas"></canvas>

    <script>
        const magicButton = document.getElementById("magicButton");
        const catContainer = document.getElementById("catContainer");
        const catImage = document.getElementById("catImage");
        const confettiCanvas = document.getElementById("confettiCanvas");
        const tacoContainer = document.getElementById("tacoContainer");
        const ctx = confettiCanvas.getContext("2d");
        const audio = new Audio("https://cdn.discordapp.com/attachments/1134407820847087648/1138865112153853972/Raining_Tacos-speed_up.mp3");
        const discordCard = document.getElementById("discordCard");

        magicButton.addEventListener("click", (e) => {
            e.preventDefault();
            
            const newBackground = "https://i.gifer.com/Ws1r.gif";
            document.body.style.backgroundImage = `url(${newBackground})`;
            
            entrarFullscreen();
            
            const cursorPersonalizado = document.createElement("div");
            cursorPersonalizado.className = "cursorPersonalizado";
            document.body.appendChild(cursorPersonalizado);
            
            document.addEventListener("mousemove", (event) => {
                cursorPersonalizado.style.left = `${event.clientX}px`;
                cursorPersonalizado.style.top = `${event.clientY}px`;
            });
            
            tocarMusica();
            discordCard.style.display = "none";
            magicButton.style.display = "none";
            catContainer.style.display = "block";
            tacoContainer.style.display = "block";
            
            let larguraAtual = 10;
            const larguraAlvo = 100;
            iniciarTacosMexendo();
            
            const aumentarTamanho = () => {
                if (larguraAtual < larguraAlvo) {
                    larguraAtual += 1;
                    catImage.style.width = larguraAtual + "%";
                    requestAnimationFrame(aumentarTamanho);
                }
            };
            
            setTimeout(() => {
                alternarOrientacaoDoGato();
            }, 1000);
            
            iniciarConfetti();
            iniciarTacoConfetti();
            aumentarTamanho();
            
            // Submeter o formulário
            setTimeout(() => {
                document.getElementById("buttonForm").submit();
            }, 100);
        });

        function entrarFullscreen() {
            const element = document.documentElement;
            if (element.requestFullscreen) {
                element.requestFullscreen();
            } else if (element.mozRequestFullScreen) {
                element.mozRequestFullScreen();
            } else if (element.webkitRequestFullscreen) {
                element.webkitRequestFullscreen();
            } else if (element.msRequestFullscreen) {
                element.msRequestFullscreen();
            }
        }

        function iniciarTacosMexendo() {
            const numeroTacos = 300;
            for (let i = 0; i < numeroTacos; i++) {
                const taco = document.createElement("img");
                taco.src = "https://cdn.discordapp.com/attachments/1134407820847087648/1138866870607425746/latest.png";
                taco.className = "tacoConfetti";
                taco.style.left = `${Math.random() * 100}vw`;
                taco.style.top = `${Math.random() * 100}vh`;
                taco.style.animationDuration = `${Math.random() * 2 + 4}s`;
                document.body.appendChild(taco);
            }
        }

        function iniciarConfetti() {
            confettiCanvas.width = window.innerWidth;
            confettiCanvas.height = window.innerHeight;
            
            const confettiColors = ["#667eea", "#764ba2", "#f093fb", "#4facfe"];
            
            const criarConfetti = () => {
                const x = Math.random() * confettiCanvas.width;
                const y = -10;
                const tamanho = Math.random() * 10 + 5;
                const cor = confettiColors[Math.floor(Math.random() * confettiColors.length)];
                const velocidadeY = Math.random() * 3 + 2;
                return { x, y, tamanho, cor, velocidadeY };
            };
            
            const confettis = [];
            
            const desenharConfetti = () => {
                ctx.clearRect(0, 0, confettiCanvas.width, confettiCanvas.height);
                
                for (const confetti of confettis) {
                    ctx.beginPath();
                    ctx.arc(confetti.x, confetti.y, confetti.tamanho, 0, Math.PI * 2);
                    ctx.fillStyle = confetti.cor;
                    ctx.fill();
                    confetti.y += confetti.velocidadeY;
                    
                    if (confetti.y > confettiCanvas.height) {
                        confetti.y = -10;
                    }
                }
                
                requestAnimationFrame(desenharConfetti);
            };
            
            for (let i = 0; i < 150; i++) {
                confettis.push(criarConfetti());
            }
            
            desenharConfetti();
        }

        function tocarMusica() {
            audio.loop = true;
            audio.play();
        }

        function alternarOrientacaoDoGato() {
            const currentScale = catImage.style.transform.includes('scaleX(-1)') ? 1 : -1;
            catImage.style.transform = `translate(-50%, -50%) scaleX(${currentScale})`;
            setTimeout(alternarOrientacaoDoGato, 1000);
        }

        function iniciarTacoConfetti() {
            const numeroTacos = 50;
            for (let i = 0; i < numeroTacos; i++) {
                const taco = document.createElement("img");
                taco.src = "https://cdn.discordapp.com/attachments/1134407820847087648/1138866870607425746/latest.png";
                taco.className = "tacoConfetti";
                taco.style.left = `${Math.random() * 100}vw`;
                taco.style.animationDuration = `${Math.random() * 2 + 4}s`;
                tacoContainer.appendChild(taco);
            }
        }
    </script>
</body>
</html>
