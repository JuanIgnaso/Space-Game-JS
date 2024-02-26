<?php
$this->title = 'Juego';
?>
<h1 class="text-center m-0 p-3 text-red-400">JUEGO</h1>
<h2 class="text-2xl p-4 text-center m-0 text-purple-400">Mueve la nave y dispara a los enemigos!</h2>
<main class="relative flex flex-col">
    <div class="w-1/3 flex relative justify-center m-auto">
        <div id="box"
            class="w-full relative flex aspect-square border-8 border-white bg-hero-bubbles bg-neutral-900 overflow-hidden shadow-lg shadow-white/40">
            <!-- Test -->
        </div>
        <div class="absolute left-full top-0 pl-4 hidden" id="powerUpList">
            <h3 class="whitespace-pre">Power Ups</h3>
            <div class="flex flex-col space-y-4 items-center mt-2">
                <i class="fa-solid fa-gem doublePoints text-4xl p-2 oculto"></i>
                <i class="fa-solid fa-shield-halved invencible text-4xl p-2 oculto"></i>
                <i class="fa-solid fa-angles-up penetratingBullets text-4xl p-2 oculto"></i>
            </div>
        </div>
    </div>
    <h3 class="p-2 m-auto"><span id="timeLeft"></span></h3>
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