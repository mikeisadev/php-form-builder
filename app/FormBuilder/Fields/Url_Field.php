<?php

namespace App\FormBuilder\Fields;

use App\FormBuilder\Fields\Text_Field;

/**
 * Extend text field.
 */
class Url_Field extends Text_Field {

    protected array $attributes = [
        'autocomplete'      => false,
        'placeholder'       => '',
        'required'          => false,
        'disabled'          => false,
        'pattern'           => '',
        'size'              => ''
    ];

}