<?php

namespace app\core\form;

use app\core\Model;

/**
 * Class Field
 * 
 * @author Shahzaib Hassan <shahzaibhassan1578.dev@gmail.com>
 * @package app\core
 */

class SelectField extends BaseField
{
    public array $options = [];

    public function __construct(Model $model, string $attribute, array $options)
    {
        $this->options = $options;
        parent::__construct($model, $attribute);
    }
    public function render_field(): string
    {
        $select_input = sprintf(
            '<div class="field border %s label">
            <select name="%s">
            <optgroup>
            <option selected disabled>Select an Option</option>',
            $this->model->has_error($this->attribute) ? 'invalid' : '',
            $this->attribute,
        );
        foreach ($this->options as $key => $option) {
            $select_input .= sprintf(
                '<option class="" value="%s">%s</option>',
                $key,
                ucwords($option)
            );
        }
        $select_input .= '</optgroup></select>';

        return $select_input;
    }
}