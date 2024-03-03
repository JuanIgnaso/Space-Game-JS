/*Guarda la partida en la base de datos*/
function saveGame(finished,points){
    $.ajax({
        url:'/saveGame',
        type:'POST',
        data:{
            score:points,
            game_finished:finished,
        },
        success: function(response){
            console.log('Partida guardada');
        },
        error: function(error){
            console.log(JSON.parse(error.responseText));
        }
    });
}

/*Muestra el mensaje al finalizar partida*/
function gameOver(text,points){
    box.innerHTML = `<div id="endGameInput"><h3 class='text-red-600 text-3xl self-center text-center m-auto'>${text}</h3><p class='text-center text-white text-xl'>Tu puntuación: ${points}</p></div>`;
}

export {gameOver,saveGame};