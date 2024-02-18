<h1 class="text-center">Ha ocurrido un error</h1>

<h2 class="text-center text-red-800">
    <?php echo "<span>Error " . $exception->getCode() . "</span> - " . $exception->getMessage(); ?>
</h2>