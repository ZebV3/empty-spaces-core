<?php

namespace app\core\form;

use app\core\Model;

/**
 * Class Field
 * 
 * @author Shahzaib Hassan <shahzaibhassan1578.dev@gmail.com>
 * @package app\core
 */

class TextAreaField extends BaseField
{
    public function render_field(): string
    {
        return sprintf(
            '<div class="field border %s label">
            <textarea name="%s">%s</textarea>',
            $this->model->has_error($this->attribute) ? 'invalid' : '',
            $this->attribute,
            $this->model->{$this->attribute}
        );
    }
}