<?php

use app\core\form\Form;
/** @var $this \app\core\View */
/** @var $contact_model \app\core\ContactForm */

$this->title = $title;
?>
<div class="container-sm">
    <?php $form = Form::begin('', 'post'); ?>
    <?= $form->input_field($contact_model, 'email', 'mail')->email_field() ?>
    <?= $form->checkbox_field($contact_model, 'query_type', [
        'support' => 'Customer Support',
        'hiring' => 'New Hiring',
        'quote' => 'Get a Quote'
    ]) ?>
    <?= $form->input_field($contact_model, 'subject', 'subject') ?>
    <?= $form->textarea_field($contact_model, 'message') ?>
        <button type="submit" class="secondary"> Submit</button>
    <?php Form::end(); ?>
</div>

