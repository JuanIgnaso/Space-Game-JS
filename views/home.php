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
}
?>

<h1 class="text-purple-500 font-bold">
    This is the home page
</h1>