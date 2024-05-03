<?php

namespace App\FormBuilder\Fields;

use App\FormBuilder\Fields\Text_Field;

/**
 * Extend text field.
 */
class Number_Field extends Text_Field {

    protected array $attributes = [
        'autocapitalize'    => false,
        'autocomplete'      => false,
        'placeholder'       => '',
        'required'          => false,
        'disabled'          => false,
        'min'               => '',
        'max'               => '',
        'step'              => ''
    ];

}