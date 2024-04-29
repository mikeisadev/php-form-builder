<?php

namespace App\FormBuilder\Traits;

/**
 * Add this trait if the HTML field supports "placeholder" attribute.
 */
trait FieldHasPlaceholder {

    /**
     * Placeholder value (nullable)
     */
    protected ?string $placeholder = NULL;

    /**
     * Set placeholder.
     */
    public function setPlaceholder(string $value): self {
        $this->placeholder = $value;

        return $this;
    }

    /**
     * Get placeholder.
     */
    public function getPlaceholder(): ?string {
        return $this->placeholder;
    }

}