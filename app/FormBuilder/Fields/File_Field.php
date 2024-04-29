<?php

namespace App\FormBuilder\Fields;

use App\FormBuilder\Field;

class File_Field extends Field {

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