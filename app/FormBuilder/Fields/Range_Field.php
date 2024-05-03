<?php

namespace App\FormBuilder\Fields;

use App\FormBuilder\Field;

class Range_Field extends Field {

    protected array $attributes = [
        'autocapitalize'    => false,
        'autocomplete'      => false,
        'value'             => 0,
        'disabled'          => false,
        'step'              => '',
        'min'               => '',
        'max'               => ''
    ];

}