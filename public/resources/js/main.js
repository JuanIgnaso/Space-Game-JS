        
        /*GAME ZONE*/
        let box = document.querySelector('#box');
        let score = document.querySelector('#score');//refernces the DOM element that shows the actual score
        let points = 0; //curr points of player in match
        let time = document.querySelector('#time');
        let dimensions = box.getBoundingClientRect(); 
        document.querySelectorAll('button').forEach(element => element.addEventListener('click',function(){playSoundEffect('../resources/sounds/select_click.mp3')}));
        let spawnObj, timeout, dlt, timer;
        spawnObj = timeout = dlt = timer = null;

        /*PLAYER*/
        let player = document.querySelector('.player');
        let plyrBox = player.getBoundingClientRect();
       
        /*
        Update the dimensions array on screen resize
        */
       window.addEventListener('resize',function(){dimensions = box.getBoundingClientRect()});
       
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

        function stopGame()
        {
            clearTimeout(spawnObj);
            document.removeEventListener('mousemove',trackMouse);
            box.removeEventListener('click',shoot);
            clearInterval(dlt);
        }

        function startGame()
        {
            /*
                Control the mouse movement of the user on the game screen
            */
            box.addEventListener('click',shoot);
            document.addEventListener('mousemove',trackMouse);
            document.querySelector('#start').style.display = 'none';
            box.innerHTML = '';
            score.innerHTML = points;
            dlt = setInterval(deleteFirst,timeout + 7000);
            generateMonster();
            startCountdown();
        }

        function startCountdown(){

            //Define the duration of the game, here it is 30 seconds.
            /*1000 = 1 sec*/
            var countDown = new Date().getTime() + 30000;

            timer = setInterval(function(){

                //Get current time
                var now = new Date().getTime();

                /*
                Get difference between now and the time of the game, wich is x seconds into the future.
                */
                var distance = countDown - now;

                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)) < 10 ? '0' + Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)) : Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60)) < 10 ? '0' + Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60)) : Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000) < 10 ? '0' + Math.floor((distance % (1000 * 60)) / 1000) : Math.floor((distance % (1000 * 60)) / 1000); 

                //Display the result
                document.querySelector('#timeLeft').innerHTML = /*days + "d " + hours + "h " + */minutes + ":" + seconds;

                if(distance < 0){
                    //If countdown reaches 0 show message and stop the game.
                    clearInterval(timer);
                    stopGame();
                    let t = document.createElement('div');
                    t.setAttribute('class','endGameInput');
                    t.innerHTML = `<h3 class='text-red-500 text-3xl'>Time is Up!</h3><p class="text-center text-white text-xl">Your score: ${points}</p>`;
                    saveGame(1);          
                    box.appendChild(t);
                    document.querySelector('#timeLeft').innerHTML = '';
                }
            });
        }

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
        b.setAttribute('class','bullet');
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
                    
                    //If conditions are met, then show explosion icon, delete enemy afther 0.2s, delete bullet and increase player's score.
                    enemies[index].innerHTML = '<i class=" fa-solid fa-burst " style="color: rgb(251 191 36);"></i>';
                    let explode = setTimeout(function(){enemies[index].parentNode == null ? '' : enemies[index].parentNode.removeChild(enemies[index]);},200);
                    playSoundEffect('/resources/sounds/explosion.mp3');
                    b.remove();
                    clearInterval(mover);
                    points+=10;
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

        //If the mouse is inside the box then the player moves
        trackMouse = (e) => { isInsideBox(e) ? moveMouse(e) : '';}

        /*
        Simulates enemy dissapearing
        */
        function deleteFirst(){
            let obstaclesList = document.querySelectorAll('.alien');
            if(obstaclesList.length != 0){
                obstaclesList[0].parentNode.removeChild(obstaclesList[0]);
            } 
        }


        /*Generate a new enemy inside de box*/
        function generateMonster(){
            //Modify time of enemy spawning and generates its position(left and top).
            timeout = getRndInteger(1000,2000);
            let top = getRndInteger(dimensions.top,dimensions.height - dimensions.top) + 'px';
            let left = getRndInteger(dimensions.left,dimensions.width - dimensions.left) + 'px';
            let alien =  document.createElement("div");

            /*Give the alien the position properties*/
            alien.setAttribute('class','alien');
            alien.style.top = top;
            alien.style.left = left;
            alien.innerHTML = '<i class="fa-solid fa-spaghetti-monster-flying"></i>';
            alien.addEventListener('mouseover',addEvent);

            //Inserts alien inside the game box
            box.appendChild(alien);
            let enable = setTimeout(function(){alien.classList.remove("dissabled"); alien.classList.toggle('enabled');},600);
            spawnObj = setTimeout(generateMonster,timeout);
        }

              
        /*Add the event to notice if the player interacted with an enemy*/  
        function addEvent(){
                let elementPos = this.getBoundingClientRect();
            if(
                plyrBox.right < elementPos.left ||  plyrBox.left > elementPos.right || plyrBox.bottom < elementPos.top || plyrBox.top > elementPos.bottom){
                if(this.classList.contains('enabled')){
                    //t.setAttribute('class',' whitespace-pre absolute left-[50%] translate-x-[-50%] self-center m-auto w-100');
                    box.innerHTML = `<div class="endGameInput"><h3 class='text-red-600 text-3xl self-center m-auto'>GAME OVER</h3><p class='text-center text-white text-xl'>Your score: ${points}</p></div>`;
                    playSoundEffect('/resources/sounds/game_over.mp3');
                    stopGame();
                    saveGame(0);
                    clearInterval(timer);
                }
            }
        }

        /*Generate random integer function*/
        getRndInteger = (min, max) => { return Math.floor(Math.random() * (max - min + 1) ) + min;}


        /*Plays once the sound passed has argument on the method*/
        function playSoundEffect(url){
            let sound = new Audio(url);
            sound.play();
        }
