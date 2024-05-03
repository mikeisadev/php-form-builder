<?php

namespace App\FormBuilder\Fields;

use App\FormBuilder\Field;

class Image_Field extends Field {

    protected array $attributes = [
        'width'             => '',
        'height'            => '',
        'autocapitalize'    => false,
        'autocomplete'      => false,
        'src'               => '',
        'alt'               => '',
        'disabled'          => false
    ];

}