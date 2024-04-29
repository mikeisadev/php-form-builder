<?php

namespace App\FormBuilder\Traits;

/**
 * Set of methods to check if a field has attributes.
 */
trait FieldHasSrc {

    /**
     * Alt html attribute.
     */
    protected ?string $src = null;

    /**
     * Set src html tag.
     */
    public function setSrc(string $src): self {
        $this->src = $src;

        return $this;
    }

    /**
     * Get placeholder.
     */
    public function getSrc(): ?string {
        return $this->src;
    }

}