<?php

namespace App\FormBuilder\Fields;

use App\FormBuilder\Field;
use App\FormBuilder\Traits\FieldHasPlaceholder;
use App\FormBuilder\Traits\FieldHasRequired;

class Textarea_Field extends Field {

    use FieldHasPlaceholder, FieldHasRequired;

    private ?string $rows = NULL;

    private ?string $cols = NULL;

    public function setRows(string|int $rows): self {
        $this->rows = (string) $rows;

        return $this;
    }

    public function setCols(string|int $cols): self {
        $this->cols = (string) $cols;

        return $this;
    }

    public function getRows(): ?string {
        return $this->rows;
    }

    public function getCols(): ?string {
        return $this->cols;
    }

}