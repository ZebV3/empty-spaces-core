<?php

namespace zebv3\EmptySpacesCore\form;

use zebv3\EmptySpacesCore\Model;

/**
 * Class Field
 * 
 * @author Shahzaib Hassan <shahzaibhassan1578.dev@gmail.com>
 * @package zebv3\EmptySpacesCore
 */

abstract class BaseField
{
    public Model $model;
    public string $attribute;
    abstract public function render_field(): string;

    public function __construct(Model $model, string $attribute)
    {
        $this->model = $model;
        $this->attribute = $attribute;
    }

    public function __tostring()
    {
        return sprintf(
            '
                %s
                <label>%s</label>
                <output class="invalid">%s</output>
                </div>
            ',
            $this->render_field(),
            $this->model->get_label($this->attribute),
            $this->model->get_first_error($this->attribute)
        );
    }
}