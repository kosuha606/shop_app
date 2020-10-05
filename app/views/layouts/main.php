<?php

use App\Core\AbstractController;

/** @var string $content */
/** @var AbstractController $this */

$styles = file_get_contents(__DIR__.'/../../public/css/style.css');
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Интернет магазин</title>
    <style>
        <?= $styles ?>
    </style>
</head>
<body>
    <div class="container" id="app" v-cloak>
        <div class="request" v-if="isRequest">
            <em>Идет загрузка...</em>
        </div>
        <?= $content ?>
    </div>
    <script>
        <?php foreach($this->jsVars as $name => $var) { ?>
        var <?= $name ?> = <?= json_encode($var, JSON_UNESCAPED_UNICODE) ?>;
        <?php } ?>
    </script>
    <script src="/js/dist/app.bundle.js"></script>
</body>
</html>
