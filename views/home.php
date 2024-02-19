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
    <?php
} else {
    ?>
    <ol class="flex justify-start gap-3 text-lime-400">
        <li><a href="/login">Login</a></li>
        <li>/</li>
        <li><a href="/register">Register</a></li>
    </ol>
    <?php
}
?>

<h1 class="text-purple-500 font-bold">
    This is the home page
</h1>