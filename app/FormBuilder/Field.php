<?php

namespace App\FormBuilder;

use App\FormBuilder\Fields\Fields;
use App\FormBuilder\Traits\FieldHasAttributes;
use App\Utils\Str;

class Field {

    use FieldHasAttributes;

    /**
     * Field ID.
     */
    private string $id = '';

    /**
     * Field type.
     */
    private string $type = '';

    /**
     * Field name.
     */
    private string $name = '';

    /**
     * Field label.
     */
    private ?string $label = NULL;

    /**
     * Can have label?
     */
    protected bool $hasLabel = true;

    /**
     * Field width.
     */
    private string $width = '100%';

    /**
     * Field conditional logic.
     */
    private ?array $conditionalLogic = NULL;

    /**
     * Field attributes.
     */
    protected array $attributes = [];

    /**
     * Make a field.
     */
    public static function make(string $type, string $name, ?string $label = NULL) {
        if ( empty($type) ) {
            throw new \Exception('You must specify a field type as first parameter');
        }

        if ( empty($name) ) {
            throw new \Exception('You must specify a field "name" attribute as second parameter');
        }

        $type = strtolower($type);

        if ( !in_array($type, Fields::FIELDS) ) {
            throw new \Exception('This field does not exist!');
        }

        // Return the desired field class.
        $class = __NAMESPACE__ . '\Fields\\' . ucfirst($type) . '_Field';

        return new $class($type, $name, $label);
    }

    /**
     * Private constructor set properties
     */
    private function __construct(string $type, string $name, ?string $label = NULL) {
        // Assign unique id.
        $this->id = Str::random('f_');

        // Assign other data.
        $this->setType($type);
        $this->setName($name);
        $this->setLabel($label);

        // For checkbox start without labels.
        if ('checkbox' === $type) {
            $this->hasLabel = false;
        }
    }

    /**
     * Set field type.
     */
    private function setType(string $type) {
        $this->type = $type;
    }

    /**
     * Set field name.
     */
    private function setName(string $name) {
        $this->name = $name;
    }

    /**
     * Set field label.
     */
    private function setLabel(?string $label) {
        $this->label = $label;
    }

    /**
     * Set field width.
     */
    public function setWidth(int $width, string $unit): self {
        $this->width = "{$width}{$unit}";

        return $this;
    }  

    /**
     * Set a field attribute.
     */
    public function setAttribute(string $attribute, string $value): self {
        if ( !$this->_hasAttribute($attribute) ) {
            throw new \Exception('You cannot set the attribute: "' . $attribute . '" for this field.');
        }

        $this->attributes[$attribute] = $value;

        return $this;
    }

    /**
     * Get an attribute of the field.
     */
    public function getAttribute(string $attribute) {
        if ( !$this->_hasAttribute($attribute) ) {
            throw new \Exception('The "' . $attribute . '" is not a supported attribute for this field.');
        }

        return $this->attributes[$attribute];
    }

    /**
     * Get all attributes of the field.
     */
    public function getAllAttributes() {
        return $this->attributes;
    }

    /**
     * Check if the field has attribute.
     * 
     * This function is used only in this class.
     */
    private function _hasAttribute(string $attribute): bool {
        return array_key_exists($attribute, $this->attributes);
    }

    /**
     * Check if the field has attribute and it's not empty!
     * 
     * Used for HTML rendering purposes!
     */
    public function hasAttribute(string $attribute): bool {
        if ( $this->_hasAttribute($attribute) ) {
            return !empty( $this->getAttribute($attribute) );
        }

        return false;
    }

    /**
     * Set conditional logic.
     */
    public function setConditionalLogic(array $logic): self {
        $relations = ['AND', 'OR'];

        if (!array_key_exists('relation', $logic)) {
            $logic['relation'] = 'AND';
        } else {
            if ( !in_array($logic['relation'], $relations) ) {
                throw new \Exception('Invalid relation inside conditional logic!');
            }
        }

        foreach ($logic as $index => $conf) {
            if (is_array($conf) && !array_key_exists('compare', $conf)) {
                $logic[$index]['compare'] = '=';
            }
        }

        $this->conditionalLogic = $logic;

        return $this;
    }

    /**
     * Get field id.
     */
    public function getId(): string {
        return $this->id;
    }

    /**
     * Get field type.
     */
    public function getType(): string {
        return $this->type;
    }

    /**
     * Get field name.
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * Get field label.
     */
    public function getLabel(): ?string {
        return $this->label;
    }

    /**
     * Get field width.
     */
    public function getWidth(): string {
        return $this->width;
    }

    /**
     * Get field conditional logic.
     */
    public function getConditionalLogic(): ?array {
        return $this->conditionalLogic;
    }

    /**
     * Has label?
     */
    public function hasLabel(): bool {
        return $this->hasLabel;
    }

    /**
     * Call make function statically.
     */
    public static function __callStatic($method, $args) {
        if ('make' === $method) {
            return call_user_func_array(
                [self::class, $method],
                $args
            );
        } else {
            throw new \Exception('You can only call "make" method as static method.');
        }
    }

}