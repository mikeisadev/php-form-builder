<?php

namespace App\FormBuilder\Fields;

use App\FormBuilder\Field;

class Button_Field extends Field {

    protected array $attributes = [
        'autocapitalize'        => false,
        'value'                 => '',
        'disabled'              => false,
        'popovertarget'         => '',
        'popovertargetaction'   => ''
    ];

}