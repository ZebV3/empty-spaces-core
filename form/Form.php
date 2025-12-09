<?php

namespace app\core\form;

use app\core\Model;

/**
 * Class Form
 * 
 * @author Shahzaib Hassan <shahzaibhassan1578.dev@gmail.com>
 * @package app\core
 */

class Form
{
    public static function begin(string $action, string $method)
    {
        echo sprintf('<form action="%s" method="%s">', $action, $method);
        return new Form();
    }

    public static function end()
    {
        return '</form>';
    }

    public function input_field(Model $model, $attribute, $icon)
    {
        return new InputField($model, $attribute, $icon);
    }

    public function textarea_field(Model $model, $attribute)
    {
        return new TextAreaField($model, $attribute);
    }

    public function select_field(Model $model, $attribute, $options)
    {
        return new SelectField($model, $attribute, $options);
    }

    public function radio_field(Model $model, $attribute, $inputs)
    {
        return new RadioField($model, $attribute, $inputs);
    }

    public function checkbox_field(Model $model, $attribute, $inputs)
    {
        return new CheckBoxField($model, $attribute, $inputs);
    }
}