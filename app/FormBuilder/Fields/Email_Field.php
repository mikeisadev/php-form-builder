<?php

namespace App\FormBuilder\Fields;

use App\FormBuilder\Fields\Text_Field;

/**
 * Extend the text field.
 */
class Email_Field extends Text_Field {

    protected array $attributes = [
        'autocomplete'      => false,
        'placeholder'       => '',
        'required'          => false,
        'disabled'          => false,
        'multiple'          => false,
        'pattern'           => '',
        'maxlength'         => '',
        'minlength'         => '',
        'size'              => ''
    ];

}