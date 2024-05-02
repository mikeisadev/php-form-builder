<?php

namespace App\FormBuilder\Fields;

use App\FormBuilder\Field;
use App\FormBuilder\Traits\FieldHasOptions;
use App\FormBuilder\Traits\FieldHasRequired;

class Checkbox_Field extends Field {

    use FieldHasOptions, FieldHasRequired;

}