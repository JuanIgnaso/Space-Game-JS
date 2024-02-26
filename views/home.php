<?php
use juanignaso\phpmvc\framework\Application;

$this->title = 'Home';
?>

<?php
if (!Application::isGuest()) {
    ?>
    <p>
        <?php echo Application::$app->user->getUserName(); ?> <a href="/logout">logout</a>
    </p>
    <p><a href="/editProfile">Editar mi perfil</a></p>
    <?php
} else {
    ?>
    <ol class="flex justify-start gap-3 text-lime-400">
        <li><a href="/login">Login</a></li>
        <li>/</li>
        <li><a href="/register">Registrarse</a></li>
    </ol>
    <?php
}
?>
<main class="flex flex-col items-center">
    <h1 class="text-purple-500 text-5xl font-bold">
        Space Game JS
    </h1>
    <img src="/resources/svg/space-invaders.svg" alt="" class="size-10"
        style="filter: invert(55%) sepia(7%) saturate(16%) hue-rotate(10deg) brightness(90%) contrast(85%);">
    <div class="w-2/3 border-4 border-white/50 aspect-video relative">
        <span class="material-symbols-outlined text-orange-400 absolute top-[25%] left-[48%]" style="font-size:4rem;">
            explosion
        </span>
        <div class="size-8 rounded-full absolute top-[45%] left-[45%] bg-purple-400 shadow-violet-300/50 shadow-lg">
        </div>
        <div class="size-8 rounded-full absolute top-2/3 left-[40%] bg-purple-400 shadow-violet-300/50 shadow-lg"></div>
        <i class="fa-brands fa-space-awesome text-6xl text-lime-500 absolute bottom-5 left-1/3 rotate-12"></i>
    </div>
    <button class="text-red-400 text-3xl border-8 border-purple-400 rounded-sm p-4 animate-pulse"><a href="/game"
            class="text-center">Jugar</a></button>
</main>