<?php

namespace App\FormBuilder\Fields;

use App\FormBuilder\Field;
use App\FormBuilder\Traits\FieldHasValue;

class Hidden_Field extends Field {

    use FieldHasValue;

    // Hidden fields cannot have label!
    protected bool $hasLabel = false;

}