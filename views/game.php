<?php
$this->title = 'Juego';
?>
<!-- CABECERA DE PÁGINA -->
<h1 class="flex justify-center items-center gap-2 text-center m-0 p-3 text-red-400">JUEGO <img
        src="/resources/svg/help-info-icon.svg" class="size-8 help hover:cursor-pointer" alt="ventana ayuda"
        onclick="document.querySelector('#help-Window').style.display='block'">
</h1>
<!--  -->

<!-- VENTANA AYUDA -->
<div id="help-Window"
    class="w-3/4 md:w-1/3 border-8 border-purple-400 bg-neutral-900/92 aspect-video hidden absolute left-1/2 translate-x-[-50%] z-30 p-3">
    <span class="absolute right-0 text-red-400 pr-3 hover:cursor-pointer hover:text-red-300"
        onclick="this.parentNode.style.display='none'">X</span>
    <h3 class=" text-red-400 mb-2">Como Jugar?</h3>

    <ol class="text-sm list-decimal list-inside text-white space-y-4">
        <li>Desplaza tu nave con el ratón y dispara al enemigo <img src="/resources/svg/mouse-icon.svg"
                class="size-8 inline form-icon" alt="icono de raton"></li>
        <li>Recoge los powerups <span class="text-xl">
                <i class="fa-solid fa-gem doublePoints"></i>
                <i class="fa-solid fa-shield-halved invencible"></i>
                <i class="fa-solid fa-angles-up penetratingBullets"></i>
            </span> que aparecen en el juego
        </li>
        <li>Evita entrar en contacto con los enemigos y consigue la mayor cantidad de puntos posibles</li>
    </ol>


</div>

<!-- JUEGO -->
<h2 class="text-2xl p-4 text-center m-0 text-purple-400">Mueve la nave y dispara a los enemigos!</h2>
<main class="relative flex flex-col mb-4">
    <div class=" w-[90%] md:w-1/3 flex relative justify-center m-auto">
        <div id="box"
            class="w-full relative flex aspect-square border-8 border-lime-400 bg-hero-bubbles-20 bg-neutral-900 overflow-hidden shadow-lg shadow-white/40">
        </div>

        <!-- POWERUPS -->
        <aside class="absolute left-full top-0 pl-4 hidden" id="powerUpList">
            <h3 class="whitespace-pre">Power Ups</h3>
            <div class="flex flex-col space-y-4 items-center mt-2">
                <i class="fa-solid fa-gem doublePoints text-4xl p-2 element-hidden"></i>
                <i class="fa-solid fa-shield-halved invencible text-4xl p-2 element-hidden"></i>
                <i class="fa-solid fa-angles-up penetratingBullets text-4xl p-2 element-hidden"></i>
            </div>
        </aside>
        <!-- ------------ -->

    </div>
    <h3 class="p-2 m-auto"><span id="timeLeft"></span></h3>
    <h3 class="text-center p-3">Puntuación : <span id="score">0</span></h3>

    <!-- MENU DEL JUEGO -->
    <section class="flex flex-col p-2 md:flex-row justify-center text-sm md:text-base gap-4">
        <button id="start" class="menu_button border-4 border-purple-400 p-2 text-red-400 rounded-sm">Empezar</button>
        <button class="menu_button border-4 border-purple-400 p-2 text-red-400 rounded-sm"
            onclick="setTimeout(function(){location.reload()},1500)">Empezar de
            nuevo</button>
        <button
            onclick="setTimeout(function(){window.location.replace(location.protocol + '//' + location.host + '/scoreBoard');},1500)"
            class="menu_button border-4 border-purple-400 p-2 text-red-400 rounded-sm">Scoreboard</button>
    </section>
    <!-- -------------- -->

</main>
<!-- ---------------------- -->

<div class="player"><i class="fa-brands fa-space-awesome"></i><span
        class="text-red-400 absolute top-full text-base whitespace-normal text-center" id="powerup"></span></div>


<script src="/resources/js/main.js" type="module"></script>
<!-- RECOMENDACIONES -->
<h3 class="text-red-700 flex justify-center items-center pt-4 gap-3">Importante <img class="size-8 inline svg-alert"
        src="/resources/svg/alert-circle-icon.svg" alt="alerta icono">
</h3>
<footer class="text-center text-white p-4">
    <p>Resolución mínima de Pantalla: 1300 x 720 o superior</p>
    <p>Resolución optima de Pantalla: 1920 x 1080</p>
</footer>