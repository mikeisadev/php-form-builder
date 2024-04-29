<?php

namespace App\FormBuilder\Traits;

/**
 * Add this trait if the field supports "value" HTML attribute.
 */
trait FieldHasValue {

    /**
     * Field value (nullable)
     */
    protected ?string $value = NULL;

    /**
     * Set value.
     */
    public function setValue(string $value): self {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value.
     */
    public function getValue(): ?string {
        return $this->value;
    }

}