function calcolaNuovaPosizioneCacciatore(){
	var randomDirection = Math.floor(Math.random() * 4);
	var nuovaX = cacciatoreX;
	var nuovaY = cacciatoreY;
	
	switch(randomDirection){
		case 0:
			if(nuovaX > 0) nuovaX--;
			break;
		case 1:
			if(nuovaX < R - 1) nuovaX++;
			break;
		case 2:
			if (nuovaY > 0) nuovaY--;
			break;
		case 3:
			if (nuovaY < C - 1) nuovaY++;
			break;
	}
	
	return { x: nuovaX, y: nuovaY };
	
}

function disegnaCacciatore() {
	var deltaX = ominoX - cacciatoreX;
	var deltaY = ominoY - cacciatoreY;
	
	var nuovaX = cacciatoreX;
	var nuovaY = cacciatoreY;
	
	if(Math.abs(deltaX) > Math.abs(deltaY)){
		nuovaX = deltaX > 0 ? cacciatoreX + 1 : cacciatoreX - 1;
	} else{
		nuovaY = deltaY > 0 ? cacciatoreY + 1 : cacciatoreY - 1;
	}
	
	if(piano[nuovaX][nuovaY] !== OSTACOLO && piano[nuovaX][nuovaY] !== FUNGO) {
		document.getElementById("c" + cacciatoreX + "_" + cacciatoreY).src = pathImg + piano[cacciatoreX][cacciatoreY] + ".jpg";
		
		cacciatoreX = nuovaX;
		cacciatoreY = nuovaY;
		
		document.getElementById("c" + cacciatoreX + "_" + cacciatoreY).src = pathImg + "cacciatore.jpg";
		
	}
	
	if(cacciatoreX === ominoX && cacciatoreY === ominoY){
		gameOver();
		return;
	}
}

setInterval(disegnaCacciatore, 500);