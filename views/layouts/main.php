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
</body>

</html>