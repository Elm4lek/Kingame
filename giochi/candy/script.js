document.addEventListener("DOMContentLoaded", () => {
    candyCrushGame();
});

function candyCrushGame() {
    // DOM Elements
    const grid = document.querySelector(".grid");
    const scoreDisplay = document.getElementById("score");
    const timerDisplay = document.getElementById("timer");
    const restartButtonElement = document.getElementById("restartButton");

    // Game State Variables
    const width = 8;
    const squares = [];
    let score = 0;
    let timeLeft = 0;
    let gameInterval = null;
    let timerInterval = null;

    const candyColors = [
        "url(https://raw.githubusercontent.com/arpit456jain/Amazing-Js-Projects/master/Candy%20Crush/utils/red-candy.png)",
        "url(https://raw.githubusercontent.com/arpit456jain/Amazing-Js-Projects/master/Candy%20Crush/utils/blue-candy.png)",
        "url(https://raw.githubusercontent.com/arpit456jain/Amazing-Js-Projects/master/Candy%20Crush/utils/green-candy.png)",
        "url(https://raw.githubusercontent.com/arpit456jain/Amazing-Js-Projects/master/Candy%20Crush/utils/yellow-candy.png)",
        "url(https://raw.githubusercontent.com/arpit456jain/Amazing-Js-Projects/master/Candy%20Crush/utils/orange-candy.png)",
        "url(https://raw.githubusercontent.com/arpit456jain/Amazing-Js-Projects/master/Candy%20Crush/utils/purple-candy.png)",
    ];

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

    async function sendGameScore(currentScore) {
        if (typeof host === 'undefined' || !host) {
            console.error("Error: 'host' variable is not defined. Cannot send score.");
            return { success: false, message: "Host variable not defined" };
        }
        const params = { score: currentScore };
        try {
            const response = await fetch("http://" + host + "/kingame/giochi/updateScore.php", {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(params)
            });
            
            const text = await response.text();
            console.log('Raw response from updateScore.php:', text);
            
            try {
                const result = JSON.parse(text);
                console.log('Score submission result:', result);
                return result;
            } catch (e) {
                console.error('Response from updateScore.php was not valid JSON:', text);
                if (response.ok) return { success: true, message: "Score sent, but response was not JSON.", raw: text};
                return { success: false, message: 'Invalid JSON response from server.', raw: text };
            }
        } catch (error) {
            console.error('Error sending score:', error);
            return { success: false, error: error.message };
        }
    }

    async function performServerRestartProcedures() {
        if (typeof host === 'undefined' || !host) {
            console.error("Error: 'host' variable is not defined. Cannot perform server restart procedures.");
            return { multiplayer: false, gioco: "5" }; 
        }
        try {
            const response = await fetch("http://" + host + "/kingame/giochi/restart.php");
            const text = await response.text();
            console.log("Raw response from restart.php:", text);

            const jsonStart = text.indexOf('{');
            const jsonEnd = text.lastIndexOf('}');
            
            if (jsonStart >= 0 && jsonEnd > jsonStart) {
                const jsonText = text.substring(jsonStart, jsonEnd + 1);
                try {
                    const data = JSON.parse(jsonText);
                    if (!data.tipo) data.tipo = "crea";
                    if (!data.gioco) data.gioco = "5"; 
                    if (!data.username) data.username = "guest"; 
                    if (!data.numero) data.numero = "1";
                    return data;
                } catch (e) {
                    console.error("Error parsing JSON from restart.php:", e, jsonText);
                }
            }
            return { 
                tipo: "crea", 
                gioco: "5", 
                username: "guest", 
                numero: "1",
                multiplayer: false 
            };
        } catch (error) {
            console.error("Error fetching data from restart.php:", error);
            return { 
                tipo: "crea", 
                gioco: "5", 
                username: "guest", 
                numero: "1",
                multiplayer: false 
            };
        }
    }

    async function handleGameRestart() {
        if (restartButtonElement) {
            restartButtonElement.style.display = 'none';
        }

        try {
            const restartData = await performServerRestartProcedures(); 
            
            if (restartData && typeof restartData === 'object') {
                if (restartData.multiplayer === true || (restartData.tipo && restartData.gioco)) { 
                    post("http://"+host+"/kingame/MultiplayerSystem/CreaStanza.php", restartData);
                    return;
                }
            }
            
            startGame(); 
        } catch (error) {
            console.error("Error during game restart:", error);
            startGame(); 
        }
    }
    

    function createBoard() {
    grid.innerHTML = "";
    squares.length = 0;
    for (let i = 0; i < width * width; i++) {
        const square = document.createElement("div");
        square.setAttribute("draggable", true);
        square.setAttribute("id", i);

        let randomColor = Math.floor(Math.random() * candyColors.length);
        let color = candyColors[randomColor];

        if (!color) {
            console.warn("Colore mancante per indice:", randomColor);
            color = "url('https://via.placeholder.com/70x70?text=ERROR')";
        }

        square.style.backgroundImage = color;
        grid.appendChild(square);
        squares.push(square);
    }

    squares.forEach(square => square.addEventListener("dragstart", dragStart));
    squares.forEach(square => square.addEventListener("dragend", dragEnd));
    squares.forEach(square => square.addEventListener("dragover", dragOver));
    squares.forEach(square => square.addEventListener("dragenter", dragEnter));
    squares.forEach(square => square.addEventListener("dragleave", dragLeave));
    squares.forEach(square => square.addEventListener("drop", dragDrop));
}

    let colorBeingDragged, colorBeingReplaced, squareIdBeingDragged, squareIdBeingReplaced;

    function dragStart() {
        colorBeingDragged = squares[this.id].style.backgroundImage;
        squareIdBeingDragged = parseInt(this.id);
    }
    function dragOver(e) { e.preventDefault(); }
    function dragEnter(e) { e.preventDefault(); }
    function dragLeave() {}
    function dragDrop() {
        colorBeingReplaced = squares[this.id].style.backgroundImage;
        squareIdBeingReplaced = parseInt(this.id);

        if (squareIdBeingDragged !== null && squareIdBeingReplaced !== null && squareIdBeingDragged !== squareIdBeingReplaced) {
            squares[squareIdBeingDragged].style.backgroundImage = colorBeingReplaced;
            squares[squareIdBeingReplaced].style.backgroundImage = colorBeingDragged;
        }
    }
    function dragEnd() {
        if (squareIdBeingDragged === null || squareIdBeingReplaced === null || squareIdBeingDragged === squareIdBeingReplaced) {
            resetDragVariables();
            return;
        }

        let validMoves = [
            squareIdBeingDragged - 1, squareIdBeingDragged - width,
            squareIdBeingDragged + 1, squareIdBeingDragged + width
        ];
        const isLeftEdge = (squareIdBeingDragged % width === 0);
        const isRightEdge = (squareIdBeingDragged % width === width - 1);
        if (isLeftEdge) validMoves = validMoves.filter(id => id !== squareIdBeingDragged - 1);
        if (isRightEdge) validMoves = validMoves.filter(id => id !== squareIdBeingDragged + 1);

        let isValidSwapLocation = validMoves.includes(squareIdBeingReplaced);
        
        if (isValidSwapLocation) {
            let matchFoundAfterSwap = checkForAnyMatch(true); 
            if (!matchFoundAfterSwap) {
                squares[squareIdBeingDragged].style.backgroundImage = colorBeingDragged;
                squares[squareIdBeingReplaced].style.backgroundImage = colorBeingReplaced;
            }
        } else {
            squares[squareIdBeingDragged].style.backgroundImage = colorBeingDragged;
            squares[squareIdBeingReplaced].style.backgroundImage = colorBeingReplaced;
        }
        resetDragVariables();
    }
    function resetDragVariables() {
        squareIdBeingDragged = null;
        squareIdBeingReplaced = null;
        colorBeingDragged = null;
        colorBeingReplaced = null;
    }
    
    function moveCandiesDown() { 
        let boardChanged = false;
        for (let c = 0; c < width; c++) {
            let emptyRowInCol = -1;
            for (let r = width - 1; r >= 0; r--) {
                if (squares[r * width + c].style.backgroundImage === '') {
                    emptyRowInCol = r;
                    break;
                }
            }
            if (emptyRowInCol !== -1) {
                for (let r = emptyRowInCol - 1; r >= 0; r--) {
                    if (squares[r * width + c].style.backgroundImage !== '') {
                        squares[emptyRowInCol * width + c].style.backgroundImage = squares[r * width + c].style.backgroundImage;
                        squares[r * width + c].style.backgroundImage = '';
                        boardChanged = true;
                        emptyRowInCol--;
                    }
                }
            }
        }
        return boardChanged;
    }
    function refillTopRow() {
    let boardChanged = false;
    for (let c = 0; c < width; c++) {
        if (squares[c].style.backgroundImage === '') {
            let randomColor = Math.floor(Math.random() * candyColors.length);
            let color = candyColors[randomColor];

            if (!color) {
                console.warn("Colore mancante durante refill per indice:", randomColor);
                color = "url('https://via.placeholder.com/70x70?text=ERROR')";
            }

            squares[c].style.backgroundImage = color;
            boardChanged = true;
        }
    }
    return boardChanged;
}

    function manageBoardChanges() { 
        const fell = moveCandiesDown();
        const refilled = refillTopRow();
        return fell || refilled;
    }

    function checkPattern(length, isRow, isCheckOnly = false) {
        let matchFoundAnywhere = false;
        const iterationLimitOuter = isRow ? width : width; 
        const iterationLimitInner = isRow ? (width - length + 1) : (width - length + 1);

        for (let i = 0; i < iterationLimitOuter; i++) { 
            for (let j = 0; j < iterationLimitInner; j++) { 
                let potentialMatchIndices = [];
                let firstIndex;

                if (isRow) { 
                    firstIndex = i * width + j;
                    for (let k = 0; k < length; k++) {
                        potentialMatchIndices.push(firstIndex + k);
                    }
                } else { 
                    firstIndex = j * width + i; 
                    for (let k = 0; k < length; k++) {
                        potentialMatchIndices.push(firstIndex + k * width);
                    }
                }
                
                if (!isRow && (firstIndex + (length - 1) * width >= width * width) ) continue;

                if (firstIndex < 0 || firstIndex >= squares.length || !squares[firstIndex]) continue;

                const firstColor = squares[firstIndex].style.backgroundImage;
                if (firstColor === "") continue;

                if (potentialMatchIndices.every(index => squares[index] && squares[index].style.backgroundImage === firstColor)) {
                    if (isCheckOnly) return true; 

                    score += length; 
                    scoreDisplay.innerHTML = score;
                    potentialMatchIndices.forEach(index => {
                        if(squares[index]) squares[index].style.backgroundImage = "";
                    });
                    matchFoundAnywhere = true; 
                }
            }
        }
        return matchFoundAnywhere;
    }
    function checkForAnyMatch(isCheckOnly = false) {
        if (!isCheckOnly) { 
            let foundAndClearedThisPass = false;
            let continueChecking = true;
            while(continueChecking) { 
                let clearedInIteration = false;
                if (checkPattern(4, true, false)) clearedInIteration = true;
                if (checkPattern(4, false, false)) clearedInIteration = true;
                if (checkPattern(3, true, false)) clearedInIteration = true;
                if (checkPattern(3, false, false)) clearedInIteration = true;
                
                if(clearedInIteration) {
                    foundAndClearedThisPass = true; 
                    manageBoardChanges(); 
                } else {
                    continueChecking = false; 
                }
            }
            return foundAndClearedThisPass;
        } else { 
            if (checkPattern(4, true, true)) return true;
            if (checkPattern(4, false, true)) return true;
            if (checkPattern(3, true, true)) return true;
            if (checkPattern(3, false, true)) return true;
        }
        return false;
    }
    function checkAndClearAllMatches() { 
        return checkForAnyMatch(false); 
    }

    function gameLoopAction() {
    const matchesCleared = checkAndClearAllMatches();
    const boardChangedByFall = manageBoardChanges(); 
    }

    function startGame() {
        if (restartButtonElement) {
            restartButtonElement.style.display = 'none';
        }
        
        grid.style.display = "flex";
        if (scoreDisplay.parentElement) { 
            scoreDisplay.parentElement.style.display = "flex";
        }
        
        if (gameInterval) clearInterval(gameInterval);
        if (timerInterval) clearInterval(timerInterval);

        createBoard();
        let initialMatchesCleared;
        do {
            initialMatchesCleared = checkAndClearAllMatches();
            if (initialMatchesCleared) {
                manageBoardChanges();
            }
        } while (initialMatchesCleared);


        score = 0;
        scoreDisplay.innerHTML = score;
        
        gameInterval = setInterval(gameLoopAction, 200); 

        timeLeft = 120; 
        updateTimerDisplay();
        timerInterval = setInterval(() => {
            timeLeft--;
            updateTimerDisplay();
            if (timeLeft <= 0) {
                endGame(); 
            }
        }, 1000);
        squares.forEach(square => square.setAttribute("draggable", "true"));
    }

    function updateTimerDisplay() {
        let minutes = Math.floor(timeLeft / 60);
        let seconds = timeLeft % 60;
        timerDisplay.innerHTML = `Time Left: ${minutes}:${seconds.toString().padStart(2, "0")}`;
    }

    async function endGame() {
        clearInterval(gameInterval);
        clearInterval(timerInterval); 
        squares.forEach(square => square.setAttribute("draggable", false));
        
        await sendGameScore(score); 

        if (restartButtonElement) {
            restartButtonElement.style.display = 'block'; 
        }
        timerDisplay.innerHTML = `Final Score: ${score}`; 
    }

    if (restartButtonElement) {
        restartButtonElement.addEventListener('click', handleGameRestart);
    }

    startGame(); 
}