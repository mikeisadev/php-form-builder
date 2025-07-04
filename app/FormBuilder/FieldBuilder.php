<?php

namespace App\FormBuilder;

use App\FormBuilder\FieldClasses;
use App\Utils\Str;

/**
 * Abstract class to build the field's form.
 */
abstract class FieldBuilder {

    /**
     * List of attributes with no value.
     */
    private static array $noValueAttributes = ['required', 'readonly', 'disabled', 'checked', 'multiple'];

    /**
     * Build field row.
     */
    protected static function buildFieldRow(Field $field): string {
        if (!($field instanceof Field)) {
            throw new \Exception('This is not a valid field!');
        }

        $html = (string) '';

        // echo "<pre>";
        // print_r($field);
        // echo "</pre>";

        // Build single field.
        $html .= '<div class="field-row field';
        $html .= FieldClasses::fieldWidthExists($field->getWidth()) ? ' ' . FieldClasses::getWidthClass($field->getWidth()) : '';
        $html .= $field->getConditionalLogic() ? ' hidden' : '';
        $html .= 'hidden' === $field->getType() ? ' hidden-field' : '';
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
            case 'paragraph' === $type:
                $field = static::buildParagraphField($options);
                break;
            case 'textarea' === $type:
                $field = static::buildTextareaField($options);
                break;
            case 'checkbox' === $type || 'radio' === $type:
                $field = static::buildOptionsField($options);
                break;
            case 'select' === $type:
                $field = static::buildSelectField($options);
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

        $field = '<input type="' . $type . '" id="' . $options->getId() . '" name="' . $options->getName() . '" ';

        // Build attributes.
        $field .= static::buildFieldAttributes( $options->getAllAttributes() );

        $field .= '>';
        
        return $field;
    }

    /**
     * Build an option field (checkbox or radio)
     */
    protected static function buildOptionsField(Field $options): string {
        $type = $options->getType();
        $opts = $options->getOptions(); 

        $field = '<div class="' . $type . '-field">';

        if ($opts) {
            foreach ($opts as $value => $label) {
                $checked = false;
                $_label = '';
    
                if (is_array($label)) {
                    $_label = array_key_exists('value', $label) ? $label['value'] : ( count($label) >= 1 ? $label[0] : '');
                    $checked = array_key_exists('checked', $label) ? $label['checked'] : ( count($label) === 2 ? $label[1] : false );
                }
    
                if (is_string($label)) {
                    $_label = $label;
                }
    
                $field .= static::buildOption(
                    $type, 
                    $options->getName(),
                    $value,
                    $_label,
                    $checked,
                    $options->getAllAttributes(),
                    true
                );
            }
        }

        if (!$opts && 'checkbox' === $type) {
            $field .= static::buildOption(
                $type,
                $options->getName(),
                null,
                $options->getLabel(),
                false,
                $options->getAllAttributes(),
                false
            );
        }

        $field .= '</div>';

        return $field;
    }

    /**
     * Build single option.
     */
    private static function buildOption(string $type, string $name, ?string $value, string $label, bool $checked, array $attributes, bool $multiple): string {
        $id = Str::random('f_');

        $field = '';

        $field .= '<div class="' . $type . '-option">';
        $field .= '<input type="' . $type . '" id="' . $id . '" name="' . $name . ($type === 'checkbox' && $multiple ? '[]' : null) . '"' . ($value ? 'value="' . $value . '"' : '') . ' ';

        // Build attributes.
        $field .= static::buildFieldAttributes( $attributes );

        // If checked, add flag.
        $field .= $checked ? 'checked' : null;

        $field .='>';
        $field .= '<label for="' . $id . '">' . $label . '</label>';
        $field .= '</div>';

        return $field;
    }

    /**
     * Build a text area.
     */
    protected static function buildTextareaField(Field $options): string {
        $field = '<textarea id="' . $options->getId() . '" ';
        $field .= 'name="' . $options->getName() . '" ';

        $field .= static::buildFieldAttributes( $options->getAllAttributes() );

        $field .= '>'; 
        $field .= '</textarea>';

        return $field;
    }

    /**
     * Build a paragraph.
     */
    protected static function buildParagraphField(Field $options): string {
        $field = '<p id="'. $options->getId() .'" p-name="' . $options->getName() . '">';
        $field .= $options->getLabel() ? $options->getLabel() : '';
        $field .= '</p>';

        return $field;
    }

    /**
     * Build a select field.
     */
    private static function buildSelectField(Field $options): string {
        $field = '<select id="' . $options->getId() . '" name="' . $options->getName() . '" ';
        $field .= static::buildFieldAttributes( $options->getAllAttributes() );
        $field .= '>';

        foreach ($options->getOptions() as $value => $label) {
            $field .= '<option value="'. $value .'">'. $label .'</option>';
        }
        $field .= '</select>';

        return $field;
    }

    /**
     * Build field attributes.
     */
    private static function buildFieldAttributes(array $attributes): string {
        $attrs = '';

        if ( empty($attributes) ) {
            return $attrs;
        }

        foreach ($attributes as $attribute => $value) {
            if ( in_array($attribute, static::$noValueAttributes) ) {
                $attrs .= $value ? "{$attribute} " : NULL;
            } else { 
                $attrs .= $value ? "{$attribute}='{$value}' " : NULL;
            }
        }

        return $attrs;
    }

}