<?php

namespace App\FormBuilder\Fields;

use App\FormBuilder\Field;

/**
 * Extend the text field.
 */
class Date_Field extends Field {

    protected array $attributes = [
        'autocomplete'      => false,
        'autocapitalize'    => false,
        'value'             => '',
        'required'          => false,
        'disabled'          => false,
        'min'               => '',
        'max'               => '',
        'step'              => ''
    ];

}