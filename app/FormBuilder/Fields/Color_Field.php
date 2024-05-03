<?php

namespace App\FormBuilder\Fields;

use App\FormBuilder\Field;

class Color_Field extends Field {

    protected array $attributes = [
        'autocomplete'  => false,
        'value'         => '',
        'disabled'      => false
    ];

}