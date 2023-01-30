<?php
namespace Gustiawan\LivewireFormBuilder\Facades;

use Illuminate\Support\Facades\Facade;

class FormBuilder extends Facade
{
    protected static function getFacadeAccessor()
    {
        return "FormBuilder";
    }
}
