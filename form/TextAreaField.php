<?php

namespace zebv3\EmptySpacesCore\form;

use zebv3\EmptySpacesCore\Model;

/**
 * Class Field
 * 
 * @author Shahzaib Hassan <shahzaibhassan1578.dev@gmail.com>
 * @package zebv3\EmptySpacesCore
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