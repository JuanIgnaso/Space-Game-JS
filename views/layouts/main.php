<!DOCTYPE html>
<html lang="en">
<?php
use juanignaso\phpmvc\framework\Application;

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/resources/css/main.css">
    <link rel="stylesheet" href="/resources/css/fontawesome/css/all.css">

    <!-- GOOGLE ICONS -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />


    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <title>
        <?php echo $this->title;
        ?>
    </title>
</head>

<body class="bg-neutral-900">
    <?php
    if (Application::$app->session->getFlash('success')) {
        ?>
        <div class="text-white bg-neutral-900 border-8 m-2 border-lime-400 p-3 rounded">
            <span class="text-red-500 absolute hover:cursor-pointer hover:text-red-400"
                onclick="this.parentNode.style.display='none'">X</span>
            <p class="text-center text-sm md:text-base">
                <?php echo Application::$app->session->getFlash('success'); ?>
            </p>
        </div>

        <?php
    }
    ?>
    <div class="PageContainer">
        {{content}}
    </div>

    <!-- FOOTER -->
    <footer class="text-center p-4">
        <div class="border-2 border-white m-auto w-3/4 lg:w-1/2 mt-8 mb-8"></div>
        <ol class="flex flex-col items-center space-y-2 text-white">
            <li>
                <h3 class="text-red-400">Space Game JS</h3>
            </li>
            <li><span>Contactos</span></li>
            <li>
                <ol class="flex space-x-4">
                    <li class="text-violet-400 gap-2 flex items-baseline">GitHub <a class="text-lime-400"
                            href="https://github.com/JuanIgnaso"><i class="fa-brands fa-github"></i></a></li>
                    <li class="text-violet-400 gap-2 flex items-baseline">Linkedin <a class="text-lime-400"
                            href="https://www.linkedin.com/in/juan-ignacio-navarrete-soli%C3%B1o-935308282/"><i
                                class="fa-brands fa-linkedin"></i></a></li>
                </ol>
            </li>
        </ol>
    </footer>
</body>
<script type="module">
    import { playSoundEffect } from '/resources/js/reproduceSound.js';
    document.querySelectorAll('button:not(#startGameButton)').forEach(element => element.addEventListener('click', function () { playSoundEffect('./resources/sounds/select_click.mp3') }));
</script>

</html>