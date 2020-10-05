<?php

/** @var int $status */
/** @var bool $isDebug */
/** @var \Throwable $exception */

?>

<h1>Произошла ошибка <?= $status ?></h1>

<?php if ($isDebug) { ?>
    <?= $exception->getMessage() ?>
<?php } ?>