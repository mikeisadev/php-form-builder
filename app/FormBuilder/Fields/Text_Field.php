<?php

namespace App\FormBuilder\Fields;

use App\FormBuilder\Field;
use App\FormBuilder\Traits\FieldHasPlaceholder;
use App\FormBuilder\Traits\FieldHasRequired;

class Text_Field extends Field {

    use FieldHasPlaceholder, FieldHasRequired;

}