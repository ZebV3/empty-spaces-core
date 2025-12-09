<?php
/** @var $model \app\models\User */
use app\core\form\Form;

$this->title = $title;
?>
<div class="responsive max">
    <h4>Login</h4>
    <?php $form = Form::begin('', 'post'); ?>
    <?= $form->input_field($model, 'email', 'mail') ?>
    <?= $form->input_field($model, 'password', 'lock')->password_field() ?>
        <button type="submit" class="btn btn-primary"> Login</button>
    <?php Form::end(); ?>

</div>

