<?php 
session_start();
$images = [     
    "pics/brain.png",     
    "pics/dolphin.png",     
    "pics/elephant.png",     
    "pics/monkey.png",     
    "pics/octo.png",     
    "pics/raven.png", 
];  
$randomImage = $images[array_rand($images)]; 
?>  

<!DOCTYPE html> 
<html lang="sq"> 
<head>     
    <meta charset="UTF-8">     
    <meta name="viewport" content="width=device-width, initial-scale=1.0">     
    <title>Game</title> 
    <style>
        * {margin: 0; padding: 0; box-sizing: border-box;}
        body {
            margin: 0;
            background-image: url(pics/bg.png);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: Arial, sans-serif;
        }
        .section1 {
            position: fixed;
            top: 20%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .logo {width: 400px; height: 400px; border-radius: 50%; object-fit: cover;}
        .letter-section {
            position: fixed;
            top: 40%;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 15px;
        }
        .letter-box {
            width: 200px;
            height: 60px;
            background-color: rgba(255,255,255,0.15);
            border: 3px solid #0c7230;
            border-radius: 8px;
            color: white;
            font-size: 2rem;
            font-weight: bold;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        #timerBox {width: 120px; font-size: 1.5rem;}
        .generate-btn {
            background-color: #0c7230;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 10px 20px;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s;
        }
        .generate-btn:hover {background-color: #0c723080;}
        .game-table {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border-radius: 12px;
            padding: 25px;
        }
        .game-table th {color: white; padding: 10px; text-align: center;}
        .game-table input {
            width: 100px;
            padding: 10px;
            margin: 5px;
            border-radius: 6px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            background-color: rgba(0, 0, 0, 0.4);
            color: #f1f1f1;
            font-size: 0.9rem;
        }
        button {
            padding: 8px;
            background-color: #0c7230ff;
            color: white;
            font-size: 1rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {background-color: #0c723080;}
        .modal {
            display: none;
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0,0,0,0.6);
            justify-content: center; align-items: center;
            z-index: 9999;
        }
        .modal-content {
            background: white;
            color: #222;
            padding: 20px 30px;
            border-radius: 10px;
            text-align: center;
            min-width: 250px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
        }
        .modal-header {font-size: 1.2rem; font-weight: bold; color: #0c7230; margin-bottom: 10px;}
        .modal button {margin-top: 10px; padding: 8px 15px; background-color: #0c7230; color: white; border: none; border-radius: 6px; cursor: pointer;}
        .modal button:hover {background-color: #0c723080;}
    </style>
</head> 

<body>     
    <!-- Dropdown Menu for Results -->
<div class="results-dropdown">
    <button id="resultsBtn">Check Results ▾</button>
    <div id="resultsContent" class="dropdown-content">
        <p>Loading results...</p>
    </div>
</div>

<style>
.results-dropdown {
    position: fixed;
    top: 10px;
    right: 10px;
    z-index: 1000;
    font-family: Arial, sans-serif;
}

#resultsBtn {
    background-color: #0c7230;
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 6px;
    cursor: pointer;
    font-size: 1rem;
    transition: background-color 0.3s ease;
}

#resultsBtn:hover { background-color: #0c723080; }

.dropdown-content {
    display: none;
    position: absolute;
    right: 0;
    background-color: rgba(255,255,255,0.95);
    min-width: 250px;
    max-height: 300px;
    overflow-y: auto;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.3);
    padding: 10px;
    margin-top: 5px;
}

.dropdown-content p {
    margin: 5px 0;
    font-size: 0.95rem;
    color: #222;
}

.dropdown-content p.user-result {
    cursor: default;
    padding: 5px;
    border-bottom: 1px solid #ccc;
}
</style>

<script>
const resultsBtn = document.getElementById("resultsBtn");
const resultsContent = document.getElementById("resultsContent");

resultsBtn.addEventListener("click", () => {
    if (resultsContent.style.display === "block") {
        resultsContent.style.display = "none";
        return;
    }

    resultsContent.style.display = "block";
    resultsContent.innerHTML = "<p>Loading results...</p>";

    fetch('get_results.php')
        .then(res => res.json())
        .then(data => {
            if (data.length === 0) {
                resultsContent.innerHTML = "<p>No results available yet.</p>";
                return;
            }

            resultsContent.innerHTML = ""; 

            data.forEach(user => {
                const p = document.createElement("p");
                p.className = "user-result";
                p.textContent = `User: ${user.username} | Score: ${user.score} | Time: ${user.time}s`;
                resultsContent.appendChild(p);
            });
        })
        .catch(err => {
            console.error(err);
            resultsContent.innerHTML = "<p>Error fetching results.</p>";
        });
});

window.addEventListener("click", (e) => {
    if (!resultsBtn.contains(e.target) && !resultsContent.contains(e.target)) {
        resultsContent.style.display = "none";
    }
});
</script>

    <section class="section1">
        <img src="<?php echo $randomImage; ?>" alt="Random Image" class="logo">
    </section>

    <section class="letter-section">
        <div class="letter-box" id="letterBox">—</div>
        <div class="letter-box" id="timerBox">0:00</div>
        <button type="button" class="generate-btn" id="startTimerBtn">Start Timer</button>
    </section>

    <section class="section2">         
        <form id="gameForm">             
            <table class="game-table" id="gameTable">    
                <tr>                     
                    <th>Emer</th>                     
                    <th>Mbiemer</th>                     
                    <th>Shtet</th>                     
                    <th>Qytet</th>                     
                    <th>Kafsh</th>                     
                    <th>Send</th>                 
                </tr>                 
                <tr>                     
                    <td><input type="text" name="emer[]"></td>                     
                    <td><input type="text" name="mbiemer[]"></td>                     
                    <td><input type="text" name="shtet[]"></td>                     
                    <td><input type="text" name="qytet[]"></td>                     
                    <td><input type="text" name="kafsh[]"></td>                     
                    <td><input type="text" name="send[]"></td>                     
                    <td><button type="button" id="finishBtn">Finish</button></td>                 
                </tr>             
            </table>         
        </form>     
    </section>

    <div id="customModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">LetterDash</div>
            <div id="modalMessage">Please fill in all fields before finishing!</div>
            <button id="closeModal">OK</button>
        </div>
    </div>

    <script>
        const alphabet = ["A","B","C","Ç","D","DH","E","Ë","F","G","GJ","H","I","J","K","L","LL","M","N","NJ","O","P","Q","R","RR","S","SH","T","TH","U","V","X","XH","Y","Z","ZH"];
        const letterBox = document.getElementById("letterBox");
        const timerBox = document.getElementById("timerBox");
        const startTimerBtn = document.getElementById("startTimerBtn");

        function generateLetter() {
            const randomLetter = alphabet[Math.floor(Math.random() * alphabet.length)];
            letterBox.textContent = randomLetter;
        }

      function showModal(message) {
    const modal = document.getElementById("customModal");
    const msg = document.getElementById("modalMessage");

    if (message === "login_required") {
        msg.textContent = "You must be logged in to submit a game.";
    } else {
        msg.textContent = message;
    }

    modal.style.display = "flex";
    document.getElementById("closeModal").onclick = () => {
        modal.style.display = "none";
        if (message === "login_required") {
            window.location.href = "login.php";
        }
    };
}


        function submitGame() {
            const inputs = document.querySelectorAll("#gameTable input");
            let allFilled = true;
            inputs.forEach(input => { if (input.value.trim() === "") allFilled = false; });

            if (!allFilled) { showModal("Please fill in all fields before finishing!"); return; }

            const formData = new FormData(document.getElementById("gameForm"));
            fetch('submit_game.php', {method: 'POST', body: formData})
            .then(res => res.json())
            .then(data => {
                if(data.status === 'success'){
                    showModal(data.message);
                    const table = document.getElementById("gameTable");
                    table.innerHTML = `
                        <tr>
                            <th>Emer</th><th>Mbiemer</th><th>Shtet</th><th>Qytet</th><th>Kafsh</th><th>Send</th>
                        </tr>
                        <tr>
                            <td><input type="text" name="emer[]"></td>
                            <td><input type="text" name="mbiemer[]"></td>
                            <td><input type="text" name="shtet[]"></td>
                            <td><input type="text" name="qytet[]"></td>
                            <td><input type="text" name="kafsh[]"></td>
                            <td><input type="text" name="send[]"></td>
                            <td><button type="button" id="finishBtn">Finish</button></td>
                        </tr>
                    `;
                    document.getElementById("finishBtn").addEventListener("click", submitGame);
            } else {
                showModal(data.message);
            }
        })
        .catch(err => {
            console.error(err);
            showModal("Error submitting game.");
        });
    }
document.getElementById("finishBtn").addEventListener("click", submitGame);

let timerInterval;
let time = 0;

function updateTimerDisplay() {
    const minutes = Math.floor(time / 60);
    const seconds = time % 60;
    timerBox.textContent = `${minutes}:${seconds.toString().padStart(2,'0')}`;
}

function startTimer() {
    generateLetter();
    if (timerInterval) clearInterval(timerInterval);
    time = 0;
    updateTimerDisplay();

    timerInterval = setInterval(() => {
        if (time < 60) { 
            time++;
            updateTimerDisplay();
        } else {
            clearInterval(timerInterval);

            const inputs = document.querySelectorAll("#gameTable input");
            let allFilled = true;
            inputs.forEach(input => {
                if (input.value.trim() === "") allFilled = false;
            });

            if (!allFilled) {
                showModal("Game Over.");
            } else {
                submitGame();
            }
        }
    }, 1000);
}

startTimerBtn.addEventListener("click", startTimer);


    </script>
</body> 
</html>
