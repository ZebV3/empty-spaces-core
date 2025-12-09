<?php

namespace app\core\form;

use app\core\Model;

/**
 * Class Field
 * 
 * @author Shahzaib Hassan <shahzaibhassan1578.dev@gmail.com>
 * @package app\core
 */

class CheckBoxField extends BaseField
{
    public array $inputs = [];

    public function __construct(Model $model, string $attribute, array $inputs)
    {
        $this->inputs = $inputs;
        parent::__construct($model, $attribute);
    }

    public function render_field(): string
    {
        $checkbox_input = sprintf(
            '<div class="field %s">',
            $this->model->has_error($this->attribute) ? 'invalid' : ''
        );
        foreach ($this->inputs as $key => $checkbox) {
            $checkbox_input .= sprintf(
                '<label class="checkbox">
                <input type="checkbox" name="%s" value="%s">
                <span>%s</span>
                </label>',
                $this->attribute,
                $key,
                ucwords($checkbox)
            );
        }
        return $checkbox_input;
    }
}