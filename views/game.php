<?php
$this->title = 'Juego';
?>
<h1 class="text-3xl text-center m-0 p-3 ">JUEGO</h1>
<h2 class="text-2xl p-3 text-center m-0">Mueve la nave y dispara a los enemigos!</h2>
<main class="relative flex flex-col">
    <div class="flex flex-col items-center">
        <div id="box"
            class="w-1/3 relative flex aspect-square border-8 border-white bg-hero-bubbles bg-neutral-900 overflow-hidden shadow-lg shadow-white/40">
            <!-- Test -->

        </div>
        <h3 class="p-2"><span id="timeLeft"></span></h3>

    </div>
    <h3 class="text-center p-3">Puntuación : <span id="score">0</span></h3>
    <section class="flex justify-center gap-4">
        <button id="start" class="border-4 border-white p-2 text-white rounded-md"
            onclick="startGame()">Empezar</button>
        <button class="border-4 border-white p-2 text-white rounded-md" onclick="location.reload()">Empezar de
            nuevo</button>
        <button class="border-4 border-white p-2 text-white rounded-md"><a href="/scoreBoard">Scoreboard</a></button>
    </section>

</main>

<div class="player"><i class="fa-brands fa-space-awesome"></i><span
        class="text-red-400 absolute top-full text-base whitespace-normal text-center" id="powerup"></span></div>


<script src="/resources/js/main.js"></script>
<footer class="text-center text-white p-4">
    <p>Resolución mínima de Pantalla: 1300 x 720 o superior</p>
    <p>Resolución optima de Pantalla: 1920 x 1080</p>
</footer>