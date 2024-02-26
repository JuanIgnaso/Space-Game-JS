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
    <h1 class="text-purple-500 text-5xl text-center font-bold">
        Space Game JS
    </h1>
    <img src="/resources/img/home_img.png" alt="imagen de ejemplo" class="w-full lg:w-1/2">
    <button class="text-red-400 text-3xl border-8 border-purple-400 rounded-sm p-4 animate-pulse"><a href="/game"
            class="text-center">Jugar</a></button>
</main>