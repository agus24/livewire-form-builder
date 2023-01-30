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

    /**
     * params $event Event to be sent.
     */
    public function upload(string $label = null, string $model, string $class = null, string $path, string $disk = 'local', array $options = [])
    {
        $label = $label ?? $model;

        $this->fields[] = [
            "type" => "file",
            "model" => $model,
            "label" => $label,
            "class" => $class,
            "path" => $path,
            "disk" => $disk,
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

    public function addCheckbox($label = null, $model = '', $class = null, array $choices = [], array $options = [])
    {
        $label = $label ?? $model;

        $this->fields[] = [
            "type" => "check",
            "model" => $model,
            "label" => $label,
            "class" => $class,
            "choices" => $choices,
            "options" => $options
        ];

        return $this;
    }

    public function addRadio($label = null, $model = '', $class = null, array $choices = [], array $options = [])
    {
        $label = $label ?? $model;

        $this->fields[] = [
            "type" => "radio",
            "model" => $model,
            "label" => $label,
            "class" => $class,
            "choices" => $choices,
            "options" => $options
        ];

        return $this;
    }
}

