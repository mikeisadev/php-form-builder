<?php

namespace App\FormBuilder\Traits;

/**
 * Set of methods to check if a field has attributes.
 */
trait FieldHasAlt {

    /**
     * Alt html attribute.
     */
    protected ?string $alt = null;

    /**
     * Set alt html tag.
     */
    public function setAlt(string $alt): self {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get placeholder.
     */
    public function getAlt(): ?string {
        return $this->alt;
    }

}