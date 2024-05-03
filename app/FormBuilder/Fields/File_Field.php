<?php

namespace App\FormBuilder\Fields;

use App\FormBuilder\Field;

class File_Field extends Field {

    protected array $attributes = [
        'accept'    => '',
        'capture'   => '',
        'required'  => false,
        'disabled'  => false,
        'multiple'  => false,
    ];

}