<?php

namespace App\FormBuilder\Traits;

/**
 * Set of methods to check if a field has attributes.
 */
trait FieldHasAttributes {

    /**
     * Generic function.
     * 
     * Has placeholder?
     */
    public function hasPlaceholder(): bool {
        return property_exists($this, 'placeholder') ? (!empty($this->placeholder) ? true : false) : false;
    }

    /**
     * Generic function.
     * 
     * Has value?
     */
    public function hasValue(): bool {
        return property_exists($this, 'value') ? (!empty($this->value) ? true : false) : false;
    }

    /**
     * Generic function.
     * 
     * Has alt?
     */
    public function hasAlt(): bool {
        return property_exists($this, 'alt') ? (!empty($this->alt) ? true : false) : false;
    }

    /**
     * Generic function.
     * 
     * Has src?
     */
    public function hasSrc(): bool {
        return property_exists($this, 'src') ? (!empty($this->src) ? true : false) : false;
    }

    /**
     * Generic function.
     * 
     * Has options?
     */
    public function hasOptions(): bool {
        return property_exists($this, 'options') ? (!empty($this->options) ? true : false) : false;
    }

    /**
     * Generic function.
     * 
     * Has accepted extensions?
     */
    public function hasAcceptedExts(): bool {
        return property_exists($this, 'acceptedExts') ? (!empty($this->acceptedExts) ? true : false) : false;
    }

    /**
     * Field has required function?
     */
    public function hasRequired() {
        return property_exists($this, 'required') ? true : false;
    }

}