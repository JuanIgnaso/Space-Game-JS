        /*VARIABLES------------------------------------------------------------------------------------------------------*/
        /*GAME ZONE*/
        let box = document.querySelector('#box');
        let score = document.querySelector('#score');//refernces the DOM element that shows the actual score
        let points = 0; //curr points of player in match
        let time = document.querySelector('#time');
        let dimensions = box.getBoundingClientRect(); 
        
        /*SETINTERVALS AND TIMEOUTS*/
        let spawnObj, enemyTimeout,powTimeout, dlt,dltP, timer, powUp;
        dltP = powTimeout = powUp = spawnObj = enemyTimeout = dlt = timer = null;

        /*PLAYER*/
        let player = document.querySelector('.player');
        let plyrBox = player.getBoundingClientRect();
       
        /*
        POWERUPS OBJECT
        Stores powerup status, message, soundeffect and fontawesome icon.
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

        console.log(Object.keys(powerUps));
        /*-------------------------------------------------------------------------------------------------------------------*/

        /*FUNCTIONS AND EVENTLISTENERS---------------------------------------------------------------------------------------*/

        document.querySelectorAll('button').forEach(element => element.addEventListener('click',function(){playSoundEffect('../resources/sounds/select_click.mp3')}));
        
        /*
        Update the dimensions array on screen resize
        */
       window.addEventListener('resize',function(){dimensions = box.getBoundingClientRect()});
       
        

        

        /*
        Iniciates te game:
        -adds event to shoot and track the mouse
        -cleans the enemies of previous match
        -starts countdown and enemies/powerup spawning
        */
        function startGame()
        {
            /*
                Control the mouse movement of the user on the game screen
            */
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

        /*Stops the current game*/
        function stopGame()
        {
            clearTimeout(spawnObj);
            document.removeEventListener('mousemove',trackMouse);
            box.removeEventListener('click',shoot);
            clearInterval(dlt);
            clearInterval(powUp);
            clearInterval(dltP);
        }

        /*MOUSE BEHAVIOR FUNCTIONS*/

        //If the mouse is inside the box then the player moves
        trackMouse = (e) => { isInsideBox(e) ? moveMouse(e) : '';}

        /*
        Returns boolean depending if the cursor of the user is inside the box
        */
        function isInsideBox(e)
        {
            return e.pageX >= dimensions.x && 
                e.pageX + player.offsetWidth <= dimensions.x + dimensions.width && 
                e.pageY >= dimensions.y && 
                e.pageY + player.offsetWidth <= dimensions.y + dimensions.height;
        }

        /*Move the mouse*/
        function moveMouse(e)
        {
            player.style.top = e.pageY + 'px';
            player.style.left = e.pageX + 'px';
        }

        /*------------------------*/

        function startCountdown(){

            //Define the duration of the game, here it is 30 seconds.
            var countDown = new Date().getTime() + 30000;/*1000 = 1 sec*/

            timer = setInterval(function(){

                //Get current time
                var now = new Date().getTime();

                //Get difference between now and the time of the game, wich is x seconds into the future.
                var distance = countDown - now;

                // Time calculations for minutes and seconds
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60)) < 10 ? '0' + Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60)) : Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000) < 10 ? '0' + Math.floor((distance % (1000 * 60)) / 1000) : Math.floor((distance % (1000 * 60)) / 1000); 

                //Display the result
                document.querySelector('#timeLeft').innerHTML = minutes + ":" + seconds;

                if(distance < 0){
                    //If countdown reaches 0 show message and stop the game.
                    clearInterval(timer);
                    stopGame();
                    gameOver('Se Acabo!');
                    saveGame(1);          
                    document.querySelector('#timeLeft').innerHTML = 'Tiempo!';
                }
            });
        }

        function gameOver(text){
            box.innerHTML = `<div class="endGameInput"><h3 class='text-red-600 text-3xl self-center text-center m-auto'>${text}</h3><p class='text-center text-white text-xl'>Tu puntuación: ${points}</p></div>`;
        }

        /*Saves the game into the dataBase*/
        function saveGame(finished){
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


        /*
        Shoots a bullet from player's ship
        */
       function shoot(e)
       {
        //Play the laser shoot sound effect
        playSoundEffect('/resources/sounds/laser_shot.mp3');

        //create bullet,set its class and position to where the user is pointing with the cursor
        let b = document.createElement('div');
        if(powerUps['penetratingBullets']['enabled'] == true){
            b.setAttribute('class','penetrating');
        }else{
            b.setAttribute('class','bullet normal');
        }
        
        b.style.top = e.pageY + 'px';
        b.style.left = e.pageX + 'px';
        document.body.appendChild(b);

        //Executes interval to move the bullet
        let mover = setInterval(function(){
        let enemies = document.querySelectorAll('.alien');
        let bulletHitBox = b.getBoundingClientRect();
        
            //Checks if the bullet hits an enemy
            for (let index = 0; index < enemies.length; index++) {
                let enemyHitBox = enemies[index].getBoundingClientRect();
                if(enemyHitBox.bottom > bulletHitBox.top && 
                    enemyHitBox.left < bulletHitBox.left &&  
                    enemyHitBox.right > bulletHitBox.right && 
                    enemyHitBox.bottom < bulletHitBox.bottom && 
                    enemies[index].classList.contains('enabled')){
                    if(!enemies[index].classList.contains('down')){
                        //add 20 points if double points is enabled or 10 if isnt.
                        powerUps['doublePoints']['enabled'] ? points+=20 : points+=10;
                    }
                    enemies[index].classList.toggle('down');
                    enemies[index].classList.remove('enabled');
                    enemies[index].innerHTML = '<i class="fa-solid fa-burst" style="color: rgb(251 191 36);"></i>';
                    let explode = setTimeout(function(){enemies[index].parentNode == null ? '' : enemies[index].parentNode.removeChild(enemies[index]);},200);
                    playSoundEffect('/resources/sounds/explosion.mp3');
                    if(powerUps['penetratingBullets']['enabled'] == false){
                        b.remove();
                        clearInterval(mover);//removes bullet
                    }
                    score.innerHTML = points;
                }
            }

            //Removes bullet if reaches the top of the box
            if(bulletHitBox.y < dimensions.y){
                b.remove();
                clearInterval(mover);//clears interval afther element is removed from the DOM
            }
            b.style.top = (parseInt(window.getComputedStyle(b).getPropertyValue('top')) - 5) + 'px';
        },0);
       }

       /*GAME ELEMENTS (ENEMIES/POWERUPS) RELATED FUNCTIONS----------------------------*/

       /*Generates powerUp inside the box of the game*/
        function generatePowerUp(){
            const powType = Object.keys(powerUps); //gets the keys from the  powerUps object wich are also the CSS class to use
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
                        let waste = setTimeout(function(){disablePowerUp(type)},5000); //sets timeout to turn it off afther 5 seconds.
                }
            });

        
            powUp = setTimeout(generatePowerUp,powTimeout);
        }

        //Enables powerup
        function enablePowerUp(type){
            powerUps[type]['enabled'] = true; //sets flag to true
            playSoundEffect(powerUps[type]['sound']);
            document.querySelector('#powerup').innerHTML = powerUps[type]['message'];
            document.querySelector('.' + type).classList.toggle('oculto');
            player.classList.toggle(type);
        }

        //Dissables powerup
        function disablePowerUp(type){
            powerUps[type]['enabled'] = false;
            document.querySelector('#powerup').innerHTML = '';
            document.querySelector('.' + type).classList.toggle('oculto');
            player.classList.toggle(type);
        }
        

        /*Generate a new enemy inside de box*/
        function generateMonster(){
            //Modify time of enemy spawning and generates its position(left and top).
            enemyTimeout = getRndInteger(200,2000);
            let alien =  document.createElement("div");

            /*Give the alien the position properties*/
            alien.setAttribute('class','alien dissabled ');
            alien.style.top = getRndInteger(dimensions.top,dimensions.height - dimensions.top) + 'px';
            alien.style.left = getRndInteger(dimensions.left,dimensions.width - dimensions.left) + 'px';
            alien.innerHTML = "<img src='/resources/svg/space-invaders.svg' alt='' class='size-10 object-none  overflow-hidden'>";
            alien.addEventListener('mouseover',function(){addEvent(this)});

            //Inserts alien inside the game box
            box.appendChild(alien);
            let enable = setTimeout(function(){alien.classList.remove("dissabled"); alien.classList.toggle('enabled');},600);
            spawnObj = setTimeout(generateMonster,enemyTimeout);
        }

        /*
        Simulates enemy or item dissapearing, gets the class passed by paramater and creates an array
        */
        function deleteFirst(cssClass){
            let objList = document.querySelectorAll(cssClass);
            if(objList.length != 0){objList[0].parentNode.removeChild(objList[0]);} 
        }
              
        /*Add the event to notice if the player interacted with an enemy*/  
        function addEvent(e){
            if(
                plyrBox.right < e.getBoundingClientRect().left ||  plyrBox.left > e.getBoundingClientRect().right || plyrBox.bottom < e.getBoundingClientRect().top || plyrBox.top > e.getBoundingClientRect().bottom){
                if(e.classList.contains('enabled') && !player.classList.contains('invencible')){
                    gameOver('GAME OVER!');
                    playSoundEffect('/resources/sounds/game_over.mp3');
                    stopGame();
                    saveGame(0);
                    clearInterval(timer);
                }
            }
        }
        /*----------------------------------------------------------*/

        /*Generate random integer function*/
       getRndInteger = (min, max) => { return Math.floor(Math.random() * (max - min + 1) ) + min;}


        /*Plays once the sound passed has argument on the method*/
       playSoundEffect = (url) => { let sound = new Audio(url); sound.play();}

/*-------------------------------------------------------------------------------------------------------------------*/
