<?php
/** @var $model \app\models\User */
use app\core\form\Form;

$this->title = $title;
?>
<div class="responsive min">
    <h4>Registration</h4>
    <?php $form = Form::begin('', 'post'); ?>
    <div class="row center-align">
        <div>
            <?= $form->input_field($model, 'first_name', 'id_card') ?>
        </div>
        <div>
            <?= $form->input_field($model, 'last_name', 'id_card') ?>
        </div>
    </div>
    <div class="row center-align">
        <div><?= $form->input_field($model, 'email', 'mail') ?></div>
    </div>
    <div class="row center-align">
        <div>
            <?= $form->input_field($model, 'password', 'lock')->password_field() ?>
        </div>
        <div>
            <?= $form->input_field($model, 'confirm_password', 'lock')->password_field() ?>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">
        Create Account</button>
    <?= Form::end() ?>

</div>

