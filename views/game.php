<h1 class="text-3xl text-center m-0 p-3 ">GAME</h1>
<h2 class="text-2xl p-3 text-center m-0">Move the ship and shoot the Space Monsters</h2>
<main class="relative flex flex-col">
    <div class="flex flex-col items-center">
        <div id="box"
            class="w-1/3 relative flex aspect-square border-8 border-white bg-black/25 overflow-hidden shadow-lg shadow-white/40">
            <!-- Test -->

        </div>
        <h3 class="p-2"><span id="timeLeft"></span></h3>

    </div>
    <h3 class="text-center p-3">Score : <span id="score">0</span></h3>
    <section class="flex justify-center gap-4">
        <button id="start" class="border-4 border-white p-2 text-white rounded-md" onclick="startGame()">Start</button>
        <button class="border-4 border-white p-2 text-white rounded-md" onclick="location.reload()">Restart</button>
    </section>

</main>

<div class="player"><i class="fa-brands fa-space-awesome"></i></div>

<script src="/resources/js/main.js"></script>
<footer class="text-center text-white p-4">
    <p>Minimum recomended screen resolutions: 1300 x 720 or higher</p>
    <p>Optimal screen resolutions: 1920 x 1080</p>
</footer>