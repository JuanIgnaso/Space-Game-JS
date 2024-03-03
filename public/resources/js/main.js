        /*IMPORTAR FUNCIONES DE JS EXTERNOS(a modo de prueba de importar y exportar funciones)--------------*/
        import { playSoundEffect } from './reproduceSound.js';
        import { getRndInteger } from './getRandomInteger.js';
        import { deleteFirst } from './deleteFirst.js';
        import { saveGame,gameOver } from './saveCurrentGame.js';

        /*VARIABLES------------------------------------------------------------------------------------------------------*/
        /*GAME ZONE*/
        let box = document.querySelector('#box');
        let score = document.querySelector('#score');//refernces the DOM element that shows the actual score
        let points = 0; //curr points of player in match
        let time = document.querySelector('#time');
        let dimensions = box.getBoundingClientRect();

        /*SETINTERVALS Y TIMEOUTS*/
        let spawnObj, enemyTimeout,powTimeout, dlt,dltP, timer, powUp;
        dltP = powTimeout = powUp = spawnObj = enemyTimeout = dlt = timer = null;

        /*PLAYER*/
        let player = document.querySelector('#player');
        let plyrBox = player.getBoundingClientRect();

        /*
        POWERUPS OBJECT
        Guarda el estado,mensaje,sonido e icono
        */
        let powerUps = {
            'doublePoints':{'enabled':false,
                            'message':'Double Points',
                            'sound':'/resources/sounds/power_up.mp3',
                            'icon':'<i class="fa-solid fa-gem"></i>'},

            'invencible':{
                            'enabled':false,
                            'message':'Invencible',
                            'sound':'/resources/sounds/shield_up.mp3',
                            'icon':'<i class="fa-solid fa-shield-halved"></i>'},

            'penetratingBullets':{'enabled':false,
                                  'message':'Penetrating Bullets',
                                  'sound':'/resources/sounds/charge_up.mp3',
                                  'icon':'<i class="fa-solid fa-angles-up"></i>'},
        };
        /*-------------------------------------------------------------------------------------------------------------------*/

        /*FUNCIONES Y EVENTLISTENERS---------------------------------------------------------------------------------------*/

        /*Actualiza las dimensiones cuando cambia el tamaño de la pantalla*/
        window.addEventListener('resize',function(){dimensions = box.getBoundingClientRect()});

       document.querySelector('#start').addEventListener('click',startGame);

        /*
        Inicia el juego:
        -añade el evento de disparar y mover el ratón
        -limpia la pantalla del juego anterior
        -empieza el contador y aparición de powerups y enemigos.
        */
        function startGame()
        {
            box.addEventListener('click',shoot);
            document.addEventListener('mousemove',trackMouse);
            document.querySelector('#start').style.display = 'none';
            document.querySelector('#powerUpList').classList.toggle('hidden');
            box.innerHTML = '';
            score.innerHTML = points;
            dlt = setInterval(function(){deleteFirst('.alien')},enemyTimeout + getRndInteger(8000,10000));
            generateMonster();
            startCountdown();
            generatePowerUp();
            dltP = setInterval(function(){deleteFirst('.powerUp')},powTimeout + 2000);

        }

        /*Termina el juego actual*/
        function stopGame()
        {
            clearTimeout(spawnObj);
            document.removeEventListener('mousemove',trackMouse);
            box.removeEventListener('click',shoot);
            clearInterval(dlt);
            clearInterval(powUp);
            clearInterval(dltP);
        }

        /*FUNCIONES DE COMPORTAMIENTO DEL RATÓN*/

        //Si el ratón se encuentra dentro de la caja, el jugador se mueve
        function trackMouse(e){ isInsideBox(e) ? moveMouse(e) : '';}

        /*
        Devuelve un booleano dependiendo de si el cursor del usuario está dentro de la caja
        */
        function isInsideBox(e)
        {
            return e.pageX >= dimensions.x &&
                e.pageX + player.offsetWidth <= dimensions.x + dimensions.width &&
                e.pageY >= dimensions.y &&
                e.pageY + player.offsetWidth <= dimensions.y + dimensions.height;
        }

        /*Mueve el ratón*/
        function moveMouse(e)
        {
            player.style.top = e.pageY + 'px';
            player.style.left = e.pageX + 'px';
        }

        /*------------------------*/

        function startCountdown(){

            //Define la duración del juego, aquí es de 30 segundos.
            var countDown = new Date().getTime() + 30000;/*1000 = 1 sec*/

            timer = setInterval(function(){

                //Recoge el tiempo actual
                var now = new Date().getTime();

                //Recoge la diferencia entre ahora y los 30 segundos
                var distance = countDown - now;

                // Cálculo de minutos y segundos
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60)) < 10 ? '0' + Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60)) : Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000) < 10 ? '0' + Math.floor((distance % (1000 * 60)) / 1000) : Math.floor((distance % (1000 * 60)) / 1000);

                //Muestra el resultado
                document.querySelector('#timeLeft').innerHTML = minutes + ":" + seconds;

                if(distance < 0){
                    //Si la cuenta atrás llega a 0 muestra un mensaje y detiene el juego.
                    clearInterval(timer);
                    stopGame();
                    gameOver('Se Acabo!',points);
                    saveGame(1,points);
                    document.querySelector('#timeLeft').innerHTML = 'Tiempo!';
                }
            });
        }

        /*
        Dispara una bala desde la posición del usuario
        */
       function shoot(e)
       {
        playSoundEffect('/resources/sounds/laser_shot.mp3');

        //crea el objeto, le asigna la clase y lo coloca el la posición del ratón
        let b = document.createElement('div');
        if(powerUps['penetratingBullets']['enabled'] == true){
            b.setAttribute('class','penetrating');
        }else{
            b.setAttribute('class','bullet normal');
        }

        b.style.top = e.pageY + 'px';
        b.style.left = e.pageX + 'px';
        document.body.appendChild(b);

        //Ejecuta el setInterval para mover la bala
        let mover = setInterval(function(){
        let enemies = document.querySelectorAll('.alien');
        let bulletHitBox = b.getBoundingClientRect();

            //Comprueba si la bala le dá al enemigo
            for (let index = 0; index < enemies.length; index++) {
                let enemyHitBox = enemies[index].getBoundingClientRect();
                if(enemyHitBox.bottom > bulletHitBox.top &&
                    enemyHitBox.left < bulletHitBox.left &&
                    enemyHitBox.right > bulletHitBox.right &&
                    enemyHitBox.bottom < bulletHitBox.bottom &&
                    enemies[index].classList.contains('enabled')){
                    if(!enemies[index].classList.contains('down')){
                        //añade 20 puntos si el powerup de doble puntos está activo
                        powerUps['doublePoints']['enabled'] ? points+=20 : points+=10;
                    }
                    enemies[index].classList.toggle('down');
                    enemies[index].classList.remove('enabled');
                    enemies[index].innerHTML = '<i class="fa-solid fa-burst" style="color: rgb(251 191 36);"></i>';
                    let explode = setTimeout(function(){enemies[index].parentNode == null ? '' : enemies[index].parentNode.removeChild(enemies[index]);},200);
                    playSoundEffect('/resources/sounds/explosion.mp3');
                    if(powerUps['penetratingBullets']['enabled'] == false){
                        b.remove();
                        clearInterval(mover);//elimina la bala
                    }
                    score.innerHTML = points;
                }
            }

            //Elimina la bala si llega al borde de la caja
            if(bulletHitBox.y < dimensions.y){
                b.remove();
                clearInterval(mover);//elimina el intervalo despues de que el elemento desaparezca del DOM
            }
            b.style.top = (parseInt(window.getComputedStyle(b).getPropertyValue('top')) - 5) + 'px';
        },0);
       }

       /*ELEMENTOS DEL JUEGO, FUNCIONES RELACIONADAS CON ENEMIGOS Y POWERUPS ----------------------------*/

       /*Genera el powerUp dentro de la caja*/
        function generatePowerUp(){
            const powType = Object.keys(powerUps); //recoge las llaves del objeto que contiene los powerUps que tambien son las clases de CSS a usar.
            let type = powType[getRndInteger(0,powType.length - 1)];
            powTimeout = getRndInteger(9000,12000);
            let pUp =  document.createElement("div");
            pUp.innerHTML = powerUps[type]['icon'];
            pUp.setAttribute('class',`powerUp ${type}`);
            pUp.style.top = getRndInteger(dimensions.top,dimensions.height - dimensions.top) + 'px';
            pUp.style.left = getRndInteger(dimensions.left,dimensions.width - dimensions.left) + 'px';
            box.appendChild(pUp);
            pUp.addEventListener('mouseover',function(){
                let elementPos = this.getBoundingClientRect();
                if(
                    plyrBox.right < elementPos.left ||  plyrBox.left > elementPos.right || plyrBox.bottom < elementPos.top || plyrBox.top > elementPos.bottom){
                        this.remove();
                        enablePowerUp(type);
                        let waste = setTimeout(function(){disablePowerUp(type)},5000); //Crea un timeout para desactivar el powerup al cabo de 5 segundos.
                }
            });


            powUp = setTimeout(generatePowerUp,powTimeout);
        }

        //Habilita powerup
        function enablePowerUp(type){
            powerUps[type]['enabled'] = true; //sets flag to true
            playSoundEffect(powerUps[type]['sound']);
            document.querySelector('#powerup').innerHTML = powerUps[type]['message'];
            document.querySelector(`#powerUpList .${type}`).classList.contains('element-hidden') ? document.querySelector(`#powerUpList .${type}`).classList.toggle('element-hidden') : '';
            player.classList.toggle(type);
        }

        //Deshabilita powerup
        function disablePowerUp(type){
            powerUps[type]['enabled'] = false;
            document.querySelector('#powerup').innerHTML = '';
            document.querySelector(`#powerUpList .${type}`).classList.toggle('element-hidden');
            player.classList.toggle(type);
        }


        /*Genera nuevo enemigo dentro de la caja*/
        function generateMonster(){
            //Modifica el tiempo de aparición y crea el elemento.
            enemyTimeout = getRndInteger(200,2000);
            let alien =  document.createElement("div");

            /*Asigna las propiedades de posición*/
            alien.setAttribute('class','alien dissabled ');
            alien.style.top = getRndInteger(dimensions.top,dimensions.height - dimensions.top) + 'px';
            alien.style.left = getRndInteger(dimensions.left,dimensions.width - dimensions.left) + 'px';
            alien.innerHTML = '<i class="fa-solid fa-spaghetti-monster-flying"></i>';
            alien.addEventListener('mouseover',function(){addEvent(this)});

            //Inserta el enemigo dentro de la caja
            box.appendChild(alien);
            let enable = setTimeout(function(){alien.classList.remove("dissabled"); alien.classList.toggle('enabled');},600);
            spawnObj = setTimeout(generateMonster,enemyTimeout);
        }

        /*Evento para detectar que el jugador ha entrado en contacto con el enemigo*/
        function addEvent(e){
            if(
                plyrBox.right < e.getBoundingClientRect().left ||  plyrBox.left > e.getBoundingClientRect().right || plyrBox.bottom < e.getBoundingClientRect().top || plyrBox.top > e.getBoundingClientRect().bottom){
                if(e.classList.contains('enabled') && !player.classList.contains('invencible')){
                    gameOver('GAME OVER!',points);
                    playSoundEffect('/resources/sounds/game_over.mp3');
                    stopGame();
                    saveGame(0,points);
                    clearInterval(timer);
                }
            }
        }
        /*----------------------------------------------------------*/
/*-------------------------------------------------------------------------------------------------------------------*/
