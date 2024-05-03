<?php

namespace App\FormBuilder\Fields;

use App\FormBuilder\Field;

class Text_Field extends Field {

    protected array $attributes = [
        'autocapitalize'    => false,
        'autocomplete'      => false,
        'placeholder'       => '',
        'required'          => false,
        'disabled'          => false,
        'pattern'           => '',
        'readonly'          => false,
        'size'              => ''
    ];

}