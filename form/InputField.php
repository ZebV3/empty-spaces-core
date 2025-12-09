<?php

namespace zebv3\EmptySpacesCore\form;

use zebv3\EmptySpacesCore\Model;

/**
 * Class Field
 * 
 * @author Shahzaib Hassan <shahzaibhassan1578.dev@gmail.com>
 * @package zebv3\EmptySpacesCore
 */

class InputField extends BaseField
{
    public Model $model;
    public string $attribute;
    public string $type;
    public string $icon;
    public const string TYPE_TEXT = 'text';
    public const string TYPE_PASSWORD = 'password';
    public const string TYPE_NUMBER = 'number';
    public const string TYPE_TELEPHONE = 'tel';
    public const string TYPE_EMAIL = 'email';

    public function __construct(Model $model, string $attribute, string $icon)
    {
        $this->type = self::TYPE_TEXT;
        $this->icon = $icon;
        parent::__construct($model, $attribute);
    }

    public function email_field()
    {
        $this->type = self::TYPE_EMAIL;
        return $this;
    }

    public function password_field()
    {
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }

    public function render_field(): string
    {
        return sprintf(
            '<div class="field prefix border %s label">
            <i>%s</i>
            <input type="%s" name="%s" value="%s">',
            $this->model->has_error($this->attribute) ? 'invalid' : '',
            $this->icon,
            $this->type,
            $this->attribute,
            $this->model->{$this->attribute},
        );
    }
}