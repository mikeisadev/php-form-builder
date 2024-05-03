<?php

namespace App\FormBuilder\Fields;

use App\FormBuilder\Field;

class Textarea_Field extends Field {

    protected array $attributes = [
        'readonly'      => '',
        'wrap'          => '',
        'rows'          => '',
        'cols'          => '',
        'placeholder'   => '',
        'required'      => false,
        'maxlength'     => '',
        'disabled'      => false,
        'dirname'       => '',
        'autofocus'     => ''
    ];

}