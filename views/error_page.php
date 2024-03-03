<main class="flex flex-col  p-4">
    <h1 class="text-center text-red-400 mb-6">Ha ocurrido un error</h1>
    <img src="/resources/svg/emoji-sad-face.svg" alt="" class="m-auto size-32 svg-crimson">
    <div class="arrow-up m-auto"></div>

    <div class="w-full md:w-1/2 m-auto text-center border-8 rounded border-purple-400 flex flex-col relative p-4 mb-6">
        <h2 class=" text-rose-700">
            <?php echo "<span>Error " . $exception->getCode() . "</span> - " . $exception->getMessage(); ?>
        </h2>
    </div>


    <div class="flex flex-col p-2 md:flex-row justify-center text-sm md:text-base gap-4">
        <button
            onclick="setTimeout(function(){window.location.replace(location.protocol + '//' + location.host + '/');},1500)"
            class="menu_button border-4 border-purple-400 p-2 text-red-400 rounded-sm">Volver al Inicio</button>
    </div>
</main>