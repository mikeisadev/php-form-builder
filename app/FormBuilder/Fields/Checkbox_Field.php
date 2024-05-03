<?php

namespace App\FormBuilder\Fields;

use App\FormBuilder\Field;
use App\FormBuilder\Traits\FieldHasOptions;

class Checkbox_Field extends Field {

    use FieldHasOptions;

    protected array $attributes = [
        'autocapitalize'    => false,
        'required'          => false,
        'disabled'          => false
    ];

}