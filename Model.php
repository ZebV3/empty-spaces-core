<?php

namespace zebv3\EmptySpacesCore;

/**
 * Class Model
 * 
 * @author Shahzaib Hassan <shahzaibhassan1578.dev@gmail.com>
 * @package zebv3\EmptySpacesCore
 */

abstract class Model
{
    public const string RULE_REQUIRED = 'required';
    public const string RULE_EMAIL = 'email';
    public const string RULE_MIN = 'min';
    public const string RULE_MAX = 'max';
    public const string RULE_MATCH = 'match';
    public const string RULE_UNIQUE = 'unique';

    public function load_data($data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    private function add_error_for_rule(string $attribute, string $rule, $params = [])
    {
        $message = $this->error_messages()[$rule] ?? '';
        foreach ($params as $key => $value) {
            $message = str_replace("{{$key}}", $value, $message);
        }
        $this->errors[$attribute][] = $message;
    }

    public function add_error(string $attribute, string $message)
    {
        $this->errors[$attribute][] = $message;
    }

    public function error_messages()
    {
        return [
            self::RULE_REQUIRED => 'This field is required',
            self::RULE_EMAIL => 'This field must be a valid email address',
            self::RULE_MIN => 'Minimum length of the field must be {min}',
            self::RULE_MAX => 'Maximum length of the field must be {max}',
            self::RULE_MATCH => 'This field must be the same as {match}',
            self::RULE_UNIQUE => '{unique} record already exists'
        ];
    }

    public function has_error($attribute)
    {
        return $this->errors[$attribute] ?? false;
    }

    public function get_first_error($attribute)
    {
        return $this->errors[$attribute][0] ?? '';
    }

    abstract public function rules(): array;
    public array $errors = [];

    public function labels(): array
    {
        return [];
    }

    public function get_label($attribute)
    {
        return $this->labels()[$attribute] ?? $attribute;
    }

    public function validate()
    {
        foreach ($this->rules() as $attribute => $rules) {
            $value = $this->{$attribute};
            foreach ($rules as $rule) {
                $rule_name = $rule;
                if (!is_string($rule)) {
                    $rule_name = $rule[0];
                }
                if ($rule_name === self::RULE_REQUIRED && !$value) {
                    $this->add_error_for_rule($attribute, self::RULE_REQUIRED);
                }
                if ($rule_name === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->add_error_for_rule($attribute, self::RULE_EMAIL);
                }
                if ($rule_name === self::RULE_MIN && strlen($value) < $rule['min']) {
                    $this->add_error_for_rule($attribute, self::RULE_MIN, $rule);
                }
                if ($rule_name === self::RULE_MAX && strlen($value) > $rule['max']) {
                    $this->add_error_for_rule($attribute, self::RULE_MAX, $rule);
                }
                if ($rule_name === self::RULE_MATCH && $value !== $this->{$rule['match']}) {
                    $rule['match'] = $this->get_label($rule['match']);
                    $this->add_error_for_rule($attribute, self::RULE_MATCH, $rule);
                }
                if ($rule_name === self::RULE_UNIQUE) {
                    $class_name = $rule['class'];
                    $unique_attribute = $rule['attribute'] ?? $attribute;
                    $table_name = $class_name::table_name();
                    $statement = Application::$application->db->prepare("SELECT * FROM $table_name WHERE $unique_attribute=:attr");
                    $statement->bindValue(":attr", $value);
                    $statement->execute();
                    $record = $statement->fetchObject();
                    if ($record)
                        $this->add_error_for_rule($attribute, self::RULE_UNIQUE, ['unique' => $this->get_label($attribute)]);
                }
            }
        }
        return empty($this->errors);
    }
}