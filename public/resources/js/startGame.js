//Reproduce el sonido y redirige al juego
document.getElementById('startGameButton').addEventListener('click',function(){
    let sound = new Audio('/resources/sounds/game-start.mp3');
    sound.play();
    setTimeout(function () {
        /*
            location.protocol -> http/https
            location.host -> localhost
            location.port -> :8080
        */
        window.location.replace(location.protocol + '//' + location.host + '/game');
    }, 2500);
});
