<?php

namespace App\FormBuilder\Fields;

use App\FormBuilder\Field;

class Hidden_Field extends Field {

    protected array $attributes = [
        'autocomplete'      => false,
        'autocapitalize'    => false,
        'value'             => '',
        'disabled'          => false
    ];

    // Hidden fields cannot have label!
    protected bool $hasLabel = false;

}