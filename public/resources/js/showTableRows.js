    /*
    Reutilizable con cualquier tabla.

    muestra de a poco a poco cada fila de la tabla
    */
    let scoreboardRows = document.querySelectorAll('tbody tr');
    let pos = 0;
    //Si contiene elementos ejecuta el setInterval
    if(scoreboardRows.length != 0){
        let scoreInterval = setInterval(function () {
            if (pos < scoreboardRows.length && scoreboardRows[pos].classList.contains('invisible')) {
                scoreboardRows[pos].classList.toggle('invisible');
                pos++;
            } else {
                clearInterval(scoreInterval);
            }
        }, 500);
    }
