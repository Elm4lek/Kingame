'use strict';

const canvas = document.getElementById("game");
const context = canvas.getContext("2d");
canvas.width = 640;
canvas.height = 640;

// Configurazioni del gioco
const config = {
    boxSize: 32,
    initialSnakePos: { x: 9, y: 10 },
    foodArea: { 
        xMin: 1, xMax: 17, 
        yMin: 3, yMax: 15 
    },
    speeds: {
        normal: 100,
        fast: 50
    }
};

// Stato del gioco
let gameState = {
    snake: [],
    direction: null,
    nextDirection: null,
    food: {},
    isGameOver: true,
    isGameStarted: false,
    gameLoopInterval: null
};

let scoreboard = new Scoreboard();

// Inizializzazione del gioco
function initGame() {
    const box = config.boxSize;
    gameState.snake = [{
        x: config.initialSnakePos.x * box,
        y: config.initialSnakePos.y * box
    }];
    
    gameState.direction = null;
    gameState.nextDirection = null;
    gameState.isGameOver = false;
    gameState.isGameStarted = true;
    
    scoreboard.reset();
    generateFood();
    
    if (gameState.gameLoopInterval) {
        clearInterval(gameState.gameLoopInterval);
    }
    gameState.gameLoopInterval = setInterval(mainGameLoop, config.speeds.normal);
}

function generateFood() {
    const box = config.boxSize;
    gameState.food = {
        x: Math.floor(Math.random() * (config.foodArea.xMax - config.foodArea.xMin + 1) + config.foodArea.xMin) * box,
        y: Math.floor(Math.random() * (config.foodArea.yMax - config.foodArea.yMin + 1) + config.foodArea.yMin) * box
    };
    
    // Assicuriamoci che il cibo non compaia sul serpente
    for (let segment of gameState.snake) {
        if (segment.x === gameState.food.x && segment.y === gameState.food.y) {
            generateFood();
            return;
        }
    }
}

// Gestione input
document.addEventListener("keydown", handleKeyPress);
canvas.addEventListener("click", handleCanvasClick);

function handleKeyPress(event) {
    if (gameState.isGameOver && event.code === "Space") {
        handleRestart();
        return;
    }

    if (!gameState.isGameStarted) {
        initGame();
        return;
    }

    // Gestione direzioni con buffer per input rapidi
   switch (event.code) {
        case "ArrowLeft":
        case "KeyA":
            if (gameState.direction !== "RIGHT") gameState.nextDirection = "LEFT";
            break;
        case "ArrowUp":
        case "KeyW":
            if (gameState.direction !== "DOWN") gameState.nextDirection = "UP";
            break;
        case "ArrowRight":
        case "KeyD":
            if (gameState.direction !== "LEFT") gameState.nextDirection = "RIGHT";
            break;
        case "ArrowDown":
        case "KeyS":
            if (gameState.direction !== "UP") gameState.nextDirection = "DOWN";
            break;
    }

}

async function handleCanvasClick() {
    if (!gameState.isGameStarted) {
        initGame();
    } else if (gameState.isGameOver) {
        await handleRestart();
    }
}

async function handleRestart() {
    try {
        const data = await restart();
        
        // Verifica se i dati sono validi prima di procedere
        if (data && typeof data === 'object') {
            if (data.multiplayer || (data.tipo && data.gioco)) {
                post("http://"+host+"/kingame/MultiplayerSystem/CreaStanza.php", data);
                return;
            }
        }
        
        // Fallback a single player se ci sono problemi con i dati
        initGame();
    } catch (error) {
        console.error("Errore durante il restart:", error);
        initGame(); // Fallback a single player
    }
}

// Logica principale del gioco
function mainGameLoop() {
    if (gameState.isGameOver) return;

    updateDirection();
    moveSnake();
    checkCollisions();
    drawGame();
}

function updateDirection() {
    if (gameState.nextDirection) {
        gameState.direction = gameState.nextDirection;
        gameState.nextDirection = null;
    }
}

function moveSnake() {
    if (!gameState.direction) return;

    const box = config.boxSize;
    const head = {...gameState.snake[0]};

    switch(gameState.direction) {
        case "LEFT":  head.x -= box; break;
        case "UP":    head.y -= box; break;
        case "RIGHT": head.x += box; break;
        case "DOWN":  head.y += box; break;
    }

    gameState.snake.unshift(head);
    
    if (head.x === gameState.food.x && head.y === gameState.food.y) {
        scoreboard.addScore(5);
        generateFood();
    } else {
        gameState.snake.pop();
    }
}

function checkCollisions() {
    const head = gameState.snake[0];
    const box = config.boxSize;
    
    // Controlla collisioni con i muri
    if (head.x < 0 || head.x >= canvas.width || 
        head.y < 0 || head.y >= canvas.height) {
        endGame();
        return;
    }
    
    // Controlla collisioni con il corpo
    for (let i = 1; i < gameState.snake.length; i++) {
        if (head.x === gameState.snake[i].x && head.y === gameState.snake[i].y) {
            endGame();
            return;
        }
    }
}

function endGame() {
    clearInterval(gameState.gameLoopInterval);
    gameState.isGameOver = true;
    scoreboard.setGameOver();
    drawGameOverScreen();  // Questo è sufficiente
    gameOver();
}

// Funzioni di disegno
function drawStartScreen() {
    context.fillStyle = "#DDEEFF";
    context.fillRect(0, 0, canvas.width, canvas.height);

    context.fillStyle = "black";
    context.font = "40px monospace";
    context.textAlign = "center";
    context.fillText("SNAKE", canvas.width / 2, canvas.height / 2 - 60);
    context.font = "24px monospace";
    context.fillText("CLICK TO START", canvas.width / 2, canvas.height / 2);
}

function drawGameOverScreen() {
    // Prima pulisci il canvas con un overlay semi-trasparente
    context.fillStyle = "rgba(0, 0, 0, 0.7)";
    context.fillRect(0, 0, canvas.width, canvas.height);

    // Poi disegna il testo
    context.fillStyle = "white";
    context.font = "36px monospace";
    context.textAlign = "center";
    context.fillText("GAME OVER", canvas.width / 2, canvas.height / 2 - 40);
    context.font = "24px monospace";
    context.fillText(`Score: ${scoreboard.getScore()}`, canvas.width / 2, canvas.height / 2);
    context.fillText("Press SPACE to Restart", canvas.width / 2, canvas.height / 2 + 60);
}

function drawGame() {
    const box = config.boxSize;
    
    // Se il gioco è finito, disegna solo la schermata di game over
    if (gameState.isGameOver) {
        drawGameOverScreen();
        return;
    }
    
    // Altrimenti procedi con il disegno normale del gioco
    context.fillStyle = "#DDEEFF";
    context.fillRect(0, 0, canvas.width, canvas.height);

    // Disegna serpente
    gameState.snake.forEach((segment, index) => {
        context.fillStyle = (index === 0) ? "green" : "white";
        context.fillRect(segment.x, segment.y, box, box);
        context.strokeStyle = "red";
        context.strokeRect(segment.x, segment.y, box, box);
    });

    // Disegna cibo
    context.fillStyle = "red";
    context.fillRect(gameState.food.x, gameState.food.y, box, box);

    // Disegna punteggio
    context.fillStyle = "black";
    context.font = "20px monospace";
    context.textAlign = "left";
    context.fillText(`Score: ${scoreboard.getScore()}`, box, box);
}

// Scoreboard
function Scoreboard() {
    let score = 0;
    let gameOver = true;
    let topscore = 0;

    this.reset = function() {
        score = 0;
        gameOver = false;
    };

    this.setGameOver = function() {
        gameOver = true;
        this.setTopscore();
    };

    this.isGameOver = function() {
        return gameOver;
    };

    this.addScore = function(s) {
        score += s;
    };

    this.getScore = function() {
        return score;
    };

    this.setTopscore = function() {
        if (score > topscore) {
            topscore = score;
            // Puoi aggiungere qui il salvataggio del topscore su localStorage
            // localStorage.setItem('snakeTopScore', topscore);
        }
    };

    this.getTopscore = function() {
        // Puoi recuperare il topscore da localStorage
        // const savedScore = localStorage.getItem('snakeTopScore');
        // return savedScore ? parseInt(savedScore) : topscore;
        return topscore;
    };
}

// Funzioni di networking
async function gameOver() {
    const params = { score: scoreboard.getScore() };
    try {
        const response = await fetch("http://"+host+"/kingame/giochi/updateScore.php", {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(params)
        });
        
        const text = await response.text();
        console.log('Risposta grezza:', text);
        
        try {
            const result = JSON.parse(text);
            console.log('Punteggio inviato:', result);
            return result;
        } catch (e) {
            console.log('La risposta non è JSON valido:', text);
            return { success: false, message: 'Invalid JSON response' };
        }
    } catch (error) {
        console.error('Errore invio score:', error);
        return { success: false, error: error.message };
    }
}

async function restart() {
    try {
        const response = await fetch("http://"+host+"/kingame/giochi/restart.php");
        const text = await response.text();
        console.log("Risposta grezza:", text);
        
        // Estrai il JSON dalla risposta anche se ci sono warning
        const jsonStart = text.indexOf('{');
        const jsonEnd = text.lastIndexOf('}');
        
        if (jsonStart >= 0 && jsonEnd > jsonStart) {
            const jsonText = text.substring(jsonStart, jsonEnd + 1);
            try {
                const data = JSON.parse(jsonText);
                // Assicurati che i campi necessari esistano
                if (!data.tipo) data.tipo = "crea";
                if (!data.gioco) data.gioco = "4"; // ID del gioco Snake
                if (!data.username) data.username = "guest";
                if (!data.numero) data.numero = "1";
                return data;
            } catch (e) {
                console.error("Errore nel parsing JSON:", e);
            }
        }
        
        // Dati di fallback
        return { 
            tipo: "crea", 
            gioco: "4", 
            username: "guest", 
            numero: "1",
            multiplayer: false 
        };
    } catch (error) {
        console.error("Errore durante il restart:", error);
        return { 
            tipo: "crea", 
            gioco: "4", 
            username: "guest", 
            numero: "1",
            multiplayer: false 
        };
    }
}

function post(path, params, method = 'post') {
    const form = document.createElement('form');
    form.method = method;
    form.action = path;

    for (const key in params) {
        if (params.hasOwnProperty(key)) {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = key;
            input.value = params[key];
            form.appendChild(input);
        }
    }

    document.body.appendChild(form);
    form.submit();
}

// Avvia il gioco mostrando la schermata iniziale
drawStartScreen();