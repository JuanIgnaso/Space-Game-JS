<?php
use juanignaso\phpmvc\framework\Application;

$this->title = 'Home';
?>

<?php
if (!Application::isGuest()) {
    ?>
    <header class="relative text-center lg:text-start lg:absolute p-4">
        <ol class="border-8 border-lime-400 bg-hero-plus-purpleLight-50 p-4 text-red-400 rounded ">
            <li>
                <?php echo Application::$app->user->getUserName(); ?> <span class="text-purple-400">&rsaquo;</span> <a
                    href="/logout" class="text-white hover:animate-pulse hover:text-yellow-300">logout</a>
            </li>
            <li>
                <a class="text-cyan-400 hover:animate-pulse" href="/editProfile">Editar mi perfil</a>
            </li>
        </ol>
    </header>

    <?php
}
?>

<main class="flex flex-col items-center space-y-6 p-4">
    <h1 class="text-purple-500 text-5xl text-center font-bold">
        Space Game JS
    </h1>
    <img src="/resources/img/home_img.png" alt="imagen de ejemplo" class="w-full lg:w-1/2">
    <?php
    if (Application::isGuest()) {
        ?>
        <ol class="flex justify-start gap-3 text-lime-400">
            <li><a href="/login" class="hover:animate-pulse hover:text-red-400">Login</a></li>
            <li>/</li>
            <li><a href="/register" class="hover:animate-pulse hover:text-red-400">Registrarse</a></li>
        </ol>
        <?php
    }
    ?>
    <button class="text-red-400 text-3xl border-8 border-purple-400 rounded-sm p-4 animate-pulse"><a href="/game"
            class="text-center">Jugar</a></button>
</main>