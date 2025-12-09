<?php
/** @var $exception \Execption */
?>
<section class="flex flex-col justify-center items-center">
    <p
        class="text-[8rem] font-bold text-slate-600"><?= $exception->getCode() ?>
    </p>
    <h4 class="text-slate-600"><?= $exception->getMessage() ?></h4>

</section>

