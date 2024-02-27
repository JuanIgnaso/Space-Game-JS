<main class="flex flex-col  p-4">
    <h1 class="text-center text-red-400 mb-6">Ha ocurrido un error</h1>
    <img src="/resources/svg/emoji-sad-face.svg" alt="" class="m-auto size-32 svg-crimson">
    <div class="arrow-up m-auto"></div>

    <div class="text-center border-8 rounded border-purple-400 flex flex-col relative p-2 mb-6">
        <h2 class=" text-rose-700">
            <?php echo "<span>Error " . $exception->getCode() . "</span> - " . $exception->getMessage(); ?>
        </h2>
    </div>


    <a class="group flex space-x-6 items-center m-auto hover:animate-pulse text-lime-400" href="/">
        <img src="/resources/svg/pixel-left-arrow.svg"
            class="size-8 mr-2 svg-crimson group-hover:animate-leftRight group-hover:relative" alt="">
        Volver al Inicio
    </a>
</main>