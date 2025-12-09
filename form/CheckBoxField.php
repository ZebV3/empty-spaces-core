<?php

namespace zebv3\EmptySpacesCore\form;

use zebv3\EmptySpacesCore\Model;

/**
 * Class Field
 * 
 * @author Shahzaib Hassan <shahzaibhassan1578.dev@gmail.com>
 * @package zebv3\EmptySpacesCore
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