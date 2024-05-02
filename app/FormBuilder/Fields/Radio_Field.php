<?php

namespace App\FormBuilder\Fields;

use App\FormBuilder\Field;
use App\FormBuilder\Traits\FieldHasOptions;
use App\FormBuilder\Traits\FieldHasRequired;

class Radio_Field extends Field {

    use FieldHasOptions, FieldHasRequired;

}