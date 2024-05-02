<?php

namespace App\FormBuilder\Fields;

use App\FormBuilder\Field;
use App\FormBuilder\Traits\FieldHasOptions;
use App\FormBuilder\Traits\FieldHasRequired;

class Select_Field extends Field {

    use FieldHasOptions, FieldHasRequired;

}