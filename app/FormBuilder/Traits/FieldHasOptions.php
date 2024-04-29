<?php

namespace App\FormBuilder\Traits;

trait FieldHasOptions {

    /**
     * Options.
     */
    protected array $options = [];

    /**
     * Set options.
     */
    public function setOptions(array $options): self {
        foreach ($options as $key => $value) {
            $this->options[$key] = $value;
        }

        return $this;
    }

    /**
     * Get options.
     */
    public function getOptions(): array {
        return $this->options;
    }

}