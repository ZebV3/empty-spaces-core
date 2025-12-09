<?php

namespace app\core\form;

use app\core\Model;

/**
 * Class Field
 * 
 * @author Shahzaib Hassan <shahzaibhassan1578.dev@gmail.com>
 * @package app\core
 */

class RadioField extends BaseField
{
    public array $inputs = [];

    public function __construct(Model $model, string $attribute, array $inputs)
    {
        $this->inputs = $inputs;
        parent::__construct($model, $attribute);
    }

    public function render_field(): string
    {
        $radio_input = sprintf(
            '<div class="field %s">',
            $this->model->has_error($this->attribute) ? 'invalid' : '',
        );
        foreach ($this->inputs as $key => $radio) {
            $radio_input .= sprintf(
                '
                <label class="radio">
                <input type="radio" name="%s" value="%s">
                <span>%s</span>
                </label>',
                $this->attribute,
                $key,
                ucwords($radio)
            );
        }
        return $radio_input;
    }
}