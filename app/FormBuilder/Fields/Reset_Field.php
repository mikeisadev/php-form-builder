<?php

namespace App\FormBuilder\Fields;

use App\FormBuilder\Fields\Button_Field;

class Reset_Field extends Button_Field {

    protected array $attributes = [
        'autocapitalize'        => false,
        'value'                 => '',
        'disabled'              => false
    ];

}