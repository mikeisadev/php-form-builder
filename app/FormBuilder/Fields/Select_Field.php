<?php

namespace App\FormBuilder\Fields;

use App\FormBuilder\Field;
use App\FormBuilder\Traits\FieldHasOptions;

class Select_Field extends Field {

    use FieldHasOptions;

    protected array $attributes = [
        'disabled'  => false,
        'multiple'  => false,
        'required'  => false,
        'size'      => '',
        'autofocus' => '',
    ];

}