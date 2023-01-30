<?php
namespace Gustiawan\LivewireFormBuilder;

class FormBuilder
{
    private $fields = [];

    public function __construct()
    {
        //
    }

    public static function init()
    {
        return new static;
    }

    public function getFields()
    {
        return $this->fields;
    }

    public function add(string $type = '', string $label = null, string $model = '', string $class = null, array $options = [])
    {
        $label = $label ?? $model;

        $this->fields[] = [
            "type" => $type,
            "model" => $model,
            "label" => $label,
            "class" => $class,
            "options" => $options
        ];

        return $this;
    }

    public function addSelect($label = null, $model = '', $class = null, array $choices = [], array $options = [])
    {
        array_unshift($choices, ["value" => null, "name" => "Select"]);
        $label = $label ?? $model;

        $this->fields[] = [
            "type" => "select",
            "model" => $model,
            "label" => $label,
            "class" => $class,
            "choices" => $choices,
            "options" => $options
        ];

        return $this;
    }
}

