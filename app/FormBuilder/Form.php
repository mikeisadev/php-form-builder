<?php

namespace App\FormBuilder;

use App\FormBuilder\FormBuilder;
use App\FormBuilder\Field;

class Form {
    
    /**
     * Form ID.
     */
    private ?string $formId = null;

    /**
     * Form method.
     */
    private ?string $formMethod = null;

    /**
     * Form action.
     */
    private ?string $formAction = null;

    /**
     * Form encoding type.
     */
    private ?string $formEncodingType = null;
    
    /**
     * Form title.
     */
    private ?string $formTitle = null;

    /**
     * Form description.
     */
    private ?string $formDescription = null;

    /**
     * Form steps.
     */
    public ?array $formSteps = null;

    /**
     * Form fields.
     */
    private array $formFields = [];

    /**
     * Fields config.
     * 
     * This is used with FormProcessor during validation.
     */
    private array $formFieldsConfig = [];

    /**
     * Form style.
     */
    private array $formStyle = [];

    /**
     * Allowed methods.
     */
    private array $allowedMethods = ['POST', 'GET'];

    /**
     * Allowed encoding types.
     */
    private array $allowedEncTypes = [
        'multipart/form-data',
        'application/x-www-form-urlencoded',
        'text/plain'
    ];

    /**
     * Constructor
     */
    private function __construct() {}

    /**
     * Start making the form.
     */
    private function make(string $formId, string $formTitle): self {
        $this->formId = $formId;
        $this->formTitle = $formTitle;

        return $this;
    }

    /**
     * Add form method.
     */
    public function setMethod(string $method): self {
        $method = \strtoupper($method);

        if ( empty($method) ) {
            throw new \Exception("Your method is empty! Please set a method or remove the 'addFormMethod' method");
        }

        if ( !in_array($method, $this->allowedMethods) ) {
            throw new \Exception("'{$method}' is not a valid method!");
        }

        $this->formMethod = $method;

        return $this;
    }

    /**
     * Set form description.
     */
    public function setDescription(string $formDescription): self {
        $this->formDescription = $formDescription;

        return $this;
    }

    /**
     * Add form action.
     */
    public function setAction(string $formAction): self {
        $this->formAction = $formAction;

        return $this;
    }

    /**
     * Add form encoding type.
     */
    public function setEncodingType(string $encodingType): self {
        $encodingType = strtolower($encodingType);

        if ( !in_array($encodingType, $this->allowedEncTypes) ) {
            throw new \Exception("'{$encodingType}' is not a valid encoding type!");
        }

        $this->formEncodingType = $encodingType;

        return $this;
    }

    /**
     * Set form width.
     */
    public function setWidth(int $width, string $unit): self {
        $this->formStyle['width'] = "{$width}{$unit}";

        return $this;
    }

    
    /**
     * Add steps to the form.
     */
    public function addStep(): self {
        
        return $this;
    }
    
    /**
     * Add fields to the form.
     */
    public function addFields(array $fields): self {
        foreach ($fields as $field) {
            if (!($field instanceof Field)) {
                throw new \Exception('The field must be an instance of "Field" object');
            }

            $this->formFields[] = $field;
        }

        return $this;
    }

    /**
     * Get form ID.
     */
    public function getId(): ?string {
        return $this->formId;
    }

    /**
     * Get form method.
     */
    public function getMethod(): ?string {
        return $this->formMethod;
    }

    /**
     * Get form action.
     */
    public function getAction(): ?string {
        return $this->formAction;
    }

    /**
     * Get encoding type.
     */
    public function getEncodingType(): ?string {
        return $this->formEncodingType;
    }

    /**
     * Get form title.
     */
    public function getTitle(): ?string {
        return $this->formTitle;
    }

    /**
     * Get form description.
     */
    public function getDescription(): ?string {
        return $this->formDescription;
    }

    /**
     * Get form fields.
     */
    public function getFields(): array {
        return $this->formFields;
    }

    /**
     * Get form fields configurations.
     */
    public function getFormFieldsConfig(): array {
        return $this->formFieldsConfig;
    }

    /**
     * Get form style.
     */
    public function getFormStyle(): array {
        return $this->formStyle;
    }

    /**
     * Statically call methods.
     */
    public static function __callStatic($method, $arguments): self|\Exception {
        if ('make' === $method) {
            $instance = new self();

            return call_user_func_array(
                [$instance, $method],
                $arguments
            );
        } else {
            throw new \Exception('You must call the make method!');
        }
    }

    /**
     * Build the form.
     */
    public function build() {
        FormBuilder::build($this);
    }

    /**
     * On form destruct build the form.
     */
    // public function __destruct() {
    //     FormBuilder::build($this);
    // }

}