<?php

namespace App\FormBuilder\Fields;

use App\FormBuilder\Field;
use App\FormBuilder\Traits\FieldHasValue;
use App\FormBuilder\Traits\FieldHasRequired;

/**
 * Extend the text field.
 */
class Date_Field extends Field {

    use FieldHasValue, FieldHasRequired;

}