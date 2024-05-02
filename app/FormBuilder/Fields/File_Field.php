<?php

namespace App\FormBuilder\Fields;

use App\FormBuilder\Field;
use App\FormBuilder\Traits\FieldHasRequired;

class File_Field extends Field {

    use FieldHasRequired;

    protected ?array $acceptedExts = null;

    public function setAcceptedExts(array $exts): self {
        foreach ($exts as $ext) {
            $this->acceptedExts[] = $ext;
        }

        return $this;
    }

    public function getAcceptedExts(): ?array {
        return $this->acceptedExts;
    }

}