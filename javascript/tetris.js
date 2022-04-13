const gamePieces = {
    "L":[[2,2],[2,1],[2,3],[1,3]],
    "Z":[[2,2],[1,1],[2,1],[2,3]],
    "S":[[2,2],[1,2],[2,1],[3,1]],
    "T":[[2,2],[1,1],[2,1],[3,1]],
    "O":[[2,2],[1,1],[1,2],[2,1]],
    "I":[[1,3],[1,1],[1,2],[1,4]]
}

var btn = document.getElementById("startStopButton");
var scoreForm  = document.getElementById("scoreForm");
var scoreFormValue = document.getElementById("scoreValue");
var scoreCounter = document.getElementById("score");
const element = document.getElementById("tetris-bg");

var gridArray
var score

var music

var pieceTypes = ["L", "Z", "S", "T", "O", "I"]

var gameOver = false;
var paused = false;
var blockPlaced = true;
var myInterval;
var turnsWaited;
var myInterval;
var gridNumber = 0;

var piece;
var pieceCoords = [[], [], [], []];

function handleStartStopButton() {
    if(btn.innerText === "Start the game"){
        btn.innerText = "Pause";
        window.startGame();
    }else if(btn.innerText === "Pause"){
        btn.innerText = "Resume";
        window.pauseGame();
    }else if(btn.innerText === "Resume"){
        btn.innerText = "Pause";
        window.resumeGame();
    }
}

function startGame() {
    music = new Audio("/music/music.mp3");
    console.log(music)
    music.play();
    console.log("starting the game")
    score = 0;
    gridArray = [[" "," "," "," "," "," "," "," "," "," "],[" "," "," "," "," "," "," "," "," "," "],[" "," "," "," "," "," "," "," "," "," "],[" "," "," "," "," "," "," "," "," "," "],
                [" "," "," "," "," "," "," "," "," "," "],[" "," "," "," "," "," "," "," "," "," "],[" "," "," "," "," "," "," "," "," "," "],[" "," "," "," "," "," "," "," "," "," "],
                [" "," "," "," "," "," "," "," "," "," "],[" "," "," "," "," "," "," "," "," "," "],[" "," "," "," "," "," "," "," "," "," "],[" "," "," "," "," "," "," "," "," "," "],
                [" "," "," "," "," "," "," "," "," "," "],[" "," "," "," "," "," "," "," "," "," "],[" "," "," "," "," "," "," "," "," "," "],[" "," "," "," "," "," "," "," "," "," "],
                [" "," "," "," "," "," "," "," "," "," "],[" "," "," "," "," "," "," "," "," "," "],[" "," "," "," "," "," "," "," "," "," "],[" "," "," "," "," "," "," "," "," "," "]];
    displayBlocks()
    while (!gameOver && !paused && blockPlaced){
        nextBlock();
    }
}

function nextBlock(){
    score+=1;
    scoreCounter.innerText = "Score: " + String(score);
    makeNewPiece();
    if (!checkGameOver()){
        placeNewPiece();
        displayBlocks()
        window.onkeydown = function(key){
            switch (key.code){
                case "ArrowLeft":
                    moveBlockLeft();
                    break;
                case "ArrowRight":
                    moveBlockRight();
                    break;
                case "ArrowDown":
                    moveBlockDown();
                    break;
                case "ArrowUp":
                    rotateBlock();
                    break;
                case "KeyP":
                    if (paused){
                        btn.innerText = "Pause";
                        resumeGame();
                    } else {
                        btn.innerText = "Resume";
                        pauseGame();
                    }
                    break;
            }
        }
        myInterval = setInterval(moveBlockDown, 1000);
    } else {
        endGame();
    }
}

function pauseGame() {
    paused = true;
    music.pause();
    clearInterval(myInterval);
}

function resumeGame() {
    paused = false;
    music.play();
    myInterval = setInterval(moveBlockDown, 1000);
}

function endGame() {
    gameOver = true;
    console.log("Game Over")
    clearInterval(myInterval);
    console.log(score)
    scoreFormValue.value = Number(score);
    console.log(scoreFormValue)
    scoreForm.submit()
}

function makeNewPiece() {
    turnsWaited=0;
    blockPlaced=false;
    currentBlock = pieceTypes[Math.floor(Math.random()*pieceTypes.length)];
    for (i=0;i<gamePieces[currentBlock].length;i++){
        pieceCoords[i] = gamePieces[currentBlock][i].slice();
    }
    for (i=0;i<pieceCoords.length;i++){
        pieceCoords[i][0] -= 1;
        pieceCoords[i][1] += 3;
    }
}

function checkGameOver(){
    for (i=0;i<pieceCoords.length;i++){
        if (gridArray[pieceCoords[i][0]][pieceCoords[i][1]]!=" "){
            return(true)
        }
    return(false)
    }
}//#THIS NEEDS CHECKING

function placeNewPiece(){
    for (i=0;i<pieceCoords.length;i++){
        gridArray[pieceCoords[i][0]][pieceCoords[i][1]] = currentBlock;
    }
}

function updateGridArray(){
    var newGridArray = [[" "," "," "," "," "," "," "," "," "," "],[" "," "," "," "," "," "," "," "," "," "],[" "," "," "," "," "," "," "," "," "," "],[" "," "," "," "," "," "," "," "," "," "],
                [" "," "," "," "," "," "," "," "," "," "],[" "," "," "," "," "," "," "," "," "," "],[" "," "," "," "," "," "," "," "," "," "],[" "," "," "," "," "," "," "," "," "," "],
                [" "," "," "," "," "," "," "," "," "," "],[" "," "," "," "," "," "," "," "," "," "],[" "," "," "," "," "," "," "," "," "," "],[" "," "," "," "," "," "," "," "," "," "],
                [" "," "," "," "," "," "," "," "," "," "],[" "," "," "," "," "," "," "," "," "," "],[" "," "," "," "," "," "," "," "," "," "],[" "," "," "," "," "," "," "," "," "," "],
                [" "," "," "," "," "," "," "," "," "," "],[" "," "," "," "," "," "," "," "," "," "],[" "," "," "," "," "," "," "," "," "," "],[" "," "," "," "," "," "," "," "," "," "]];
    

    for (i=0;i<pieceCoords.length;i++){
        newGridArray[pieceCoords[i][0]][pieceCoords[i][1]]=currentBlock;
    }

    for(i=0;i<20;i++){
        for(j=0;j<10;j++){
            if (gridArray[i][j].includes("#")){
                newGridArray[i][j] = gridArray[i][j]
            }
        }
    }

    gridArray = newGridArray;
    displayBlocks()
}

function displayBlocks(){
    for (i=0;i<20;i++){
        for (j=0;j<10;j++){
            if (gridNumber!=0){
                if(gridArray[i][j]!=" "){
                    var block = document.createElement('div');
                    block.classList.add('block');
                    block.setAttribute('id',gridArray[i][j].split("")[0]);
                    block.style.transform = "translate(0px, -" + String(600*gridNumber) + "px)";
                    block.style.zIndex = gridNumber;
                    element.appendChild(block);   
                } else {
                    var block = document.createElement('div');
                    block.classList.add('block');
                    block.setAttribute('id','empty');   
                    block.style.transform = "translate(0px, -" + String(600*gridNumber) + "px)";
                    block.style.zIndex = gridNumber;
                    element.appendChild(block);
                }
            } else {
                if(gridArray[i][j]!=" "){
                    var block = document.createElement('div');
                    block.classList.add('block');
                    block.setAttribute('id',gridArray[i][j].split("")[0]);
                    block.style.transform = "translate(0px, 0px)";
                    block.style.zIndex = gridNumber;
                    element.appendChild(block);   
                } else {
                    var block = document.createElement('div');
                    block.classList.add('block');
                    block.setAttribute('id','empty');   
                    block.style.transform = "translate(0px, 0px)";
                    block.style.zIndex = gridNumber;
                    element.appendChild(block);
                }
            }    
        }
    }
    gridNumber += 1;
    
}

function moveBlockDown(){
    if (checkDown()=="free"){
        for (i=0;i<pieceCoords.length;i++){
            pieceCoords[i][0] += 1;
        }
        updateGridArray();
    } else if (checkDown()=="occupied"){
        fixBlock()
    }
}

function moveBlockRight(){
    if (checkRight()){
        for (i=0;i<pieceCoords.length;i++){
            pieceCoords[i][1] += 1;
        }
        updateGridArray();
    }    
}

function moveBlockLeft(){
    if (checkLeft()){
        for (i=0;i<pieceCoords.length;i++){
            pieceCoords[i][1] -= 1;
        }
        updateGridArray();
    }    
}

function rotateBlock(){
    if (checkRotate()){
        rotationOrigin = pieceCoords[0]
        oldPieceCoords = [[],[],[],[]]
        for (i=0;i<pieceCoords.length;i++){
            oldPieceCoords[i] = pieceCoords[i].slice();
        }
        for (i=0;i<pieceCoords.length;i++){
            pieceCoords[i][0] = rotationOrigin[0] - rotationOrigin[1] + oldPieceCoords[i][1];
            pieceCoords[i][1] = rotationOrigin[0] + rotationOrigin[1] - oldPieceCoords[i][0];
        }
        updateGridArray();
    }
}

function checkDown(){
    var returnValue = "free";
    for (i=0;i<pieceCoords.length;i++){
        if (pieceCoords[i][0] >= 19){
            if (turnsWaited>=1){
                returnValue = "occupied"
            } else {
                turnsWaited+=1;
                if (returnValue=="free"){
                    returnValue = "wait"
                }
            }    
        } else {
            if (gridArray[pieceCoords[i][0]+1][pieceCoords[i][1]].includes("#")){
                if (turnsWaited>=1){
                    returnValue = "occupied"
                } else {
                    turnsWaited+=1;
                    if (returnValue=="free"){
                        returnValue = "wait"
                    }
                }    
            }
        }
    }
    return returnValue;
}

function checkRight(){
    for (i=0;i<pieceCoords.length;i++){
        if (pieceCoords[i][1] >= 9){
            return false;
        } else if (gridArray[pieceCoords[i][0]][pieceCoords[i][1]+1].includes("#")){
            return false
        }
    }
    turnsWaited=0;
    return true;
}

function checkLeft(){
    for (i=0;i<pieceCoords.length;i++){
        if (pieceCoords[i][1] <= 0){
            return false;
        } else if (gridArray[pieceCoords[i][0]][pieceCoords[i][1]-1].includes("#")){
            return false
        }
    }
    turnsWaited=0;
    return true;
}

function checkRotate(){
    rotationOrigin = pieceCoords[0]
    for (i=0;i<pieceCoords.length;i++){
        var newCoord = [,]
        newCoord[0] = rotationOrigin[0] - rotationOrigin[1] + pieceCoords[i][1];
        newCoord[1] = rotationOrigin[0] + rotationOrigin[1] - pieceCoords[i][0];
        if (newCoord[0] < 0 || newCoord[0] > 19 || newCoord[1] < 0 || newCoord[1] > 9){
            return false;
        } else if (gridArray[newCoord[0]][newCoord[1]].includes("#")){
            return false;
        }
    }
    return true;
}

function fixBlock(){
    for (i=0;i<pieceCoords.length;i++){
        gridArray[pieceCoords[i][0]][[pieceCoords[i][1]]]+="#";
    }
    clearInterval(myInterval);
    blockPlaced = true;
    removeCompleteRows();
    nextBlock();
}

function removeCompleteRows(){
    for (i=0;i<20;i++){
        var full = true;
        for (j=0;j<10;j++){
            if (!gridArray[i][j].includes("#")){
                full = false;
            }
        }
        if (full){
            for (n=i;n>0;n--){
                gridArray[n] = gridArray[n-1].slice()
            }
            gridArray[0] = [" "," "," "," "," "," "," "," "," "," "]    
        }
    }
}