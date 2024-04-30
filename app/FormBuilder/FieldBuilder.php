<?php

namespace App\FormBuilder;

use App\FormBuilder\FieldClasses;
use App\Utils\Str;

/**
 * Abstract class to build the field's form.
 */
abstract class FieldBuilder {

    /**
     * Build field row.
     */
    protected static function buildFieldRow(Field $field): string {
        if (!($field instanceof Field)) {
            throw new \Exception('This is not a valid field!');
        }

        $html = (string) '';

        // echo "<pre>";
        // print_r($field->getConditionalLogic());
        // echo "</pre>";

        // Build single field.
        $html .= '<div class="field-row field';
        $html .= FieldClasses::fieldWidthExists($field->getWidth()) ? ' ' . FieldClasses::getWidthClass($field->getWidth()) : '';
        $html .= $field->getConditionalLogic() ? ' hidden' : '';
        $html .= '">';
            $html .= $field->hasLabel() ? '<label for="' . $field->getId() . '">'. $field->getLabel() .'</label>' : '';
            $html .= static::dispatchField($field);
        $html .= '</div>';

        return $html;
    }

    /**
     * Build the selected field.
     */
    protected static function dispatchField(Field $options): string {
        $type = (string) $options->getType();
        $field = (string) '';

        switch(true) {
            case 'textarea' === $type:
                $field = static::buildTextareaField($options);
                break;
            case 'checkbox' === $type || 'radio' === $type:
                $field = static::buildOptionsField($options);
                break;
            default:
                $field = static::buildField($options);
                
        }

        return $field;
    }

    /**
     * Build a field.
     */
    protected static function buildField(Field $options): string {
        $type = $options->getType() === 'datetime' ? 'datetime-local' : $options->getType();

        $field = '<input type="' . $type . '" id="' . $options->getId() . '" ';
        $field .= $options->getName() ? 'name="' . $options->getName() . '"' : '';

        $field .= $options->hasPlaceholder() ? 'placeholder="' . $options->getPlaceholder() . '"' : null;
        $field .= $options->hasValue() ? 'value="' . $options->getValue() . '"' : null;
        $field .= $options->hasAcceptedExts() ? 'accept="' . implode(',', $options->getAcceptedExts()) . '"' : null;

        $field .= '>';
        
        return $field;
    }

    /**
     * Build an option field (checkbox or radio)
     */
    protected static function buildOptionsField(Field $options) {
        $field = '<div class="' . $options->getType() . '-field">';

        foreach ($options->getOptions() as $value => $label) {
            $id = Str::random('f_');

            $field .= '<div class="' . $options->getType() . '-option">';
                $field .= '<input type="' . $options->getType() . '" id="' . $id . '" name="' . $options->getName() . '" value="' . $value . '">';
                $field .= '<label for="' . $id . '">' . $label . '</label>';
            $field .= '</div>';
        }

        $field .= '</div>';

        return $field;
    }

    /**
     * Build a text area.
     */
    protected static function buildTextareaField(Field $options) {
        $field = '<textarea id="' . $options->getId() . '" ';
        $field .= $options->getName() ? 'name="' . $options->getName() . '" ' : '';
        $field .= $options->hasPlaceholder() ? 'placeholder="' . $options->getPlaceholder() . '" ' : '';
        $field .= $options->getRows() ? 'rows="' . $options->getRows() . '" ' : '';
        $field .= $options->getCols() ? 'cols="' . $options->getCols() . '" ' : '';
        $field .= '>'; 
        $field .= '</textarea>';

        return $field;
    }

}