<?php

namespace App\FormBuilder\Traits;

/**
 * Add this trait if the field supports "value" HTML attribute.
 */
trait FieldHasRequired {

    /**
     * Field value (nullable)
     */
    protected bool $required = false;

    /**
     * Set value.
     */
    public function required(bool $bool): self {
        $this->required = $bool;

        return $this;
    }

    /**
     * Get value.
     */
    public function getRequired(): bool {
        return $this->required;
    }

}