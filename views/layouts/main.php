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

    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <title>
        <?php echo $this->title;
        ?>
    </title>
</head>

<body class="bg-neutral-900">

    <div class="PageContainer">
        {{content}}
    </div>

    <!-- FOOTER -->
    <footer class="text-center p-4">
        <ol class="flex flex-col items-center space-y-2 text-white">
            <li>
                <h3 class="text-red-400">My Notes App</h3>
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

</html>