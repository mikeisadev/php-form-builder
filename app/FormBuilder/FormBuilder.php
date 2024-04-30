<?php

namespace App\FormBuilder;

use App\FormBuilder\Form;
use App\FormBuilder\Field;
use App\FormBuilder\FieldClasses;
use App\Utils\Str;

/**
 * The final Form Builder class.
 */
class FormBuilder extends FieldBuilder {

    /**
     * Build the form.
     */
    public static function build(Form $form) {
        // Init.
        $html = (string) '';
        $fields = (array) [];

        // Set.
        $fields = $form->getFields();

        $html = '<div class="pfmb-form-wrap">';

        if ($form->getTitle()) {
            $html .= '<div class="form-header">';
            $html .= "<h2 class='form-title'>{$form->getTitle()}</h2>";
            $html .= $form->getDescription() ? "<p class='form-description'>{$form->getDescription()}</p>" : '';
            $html .= '</div>';
        }

        // Start building the form.
        $html .= '<form class="pfmb-form"';
        $html .= $form->getId() ? "id='{$form->getId()}' " : '';
        $html .= $form->getAction() ? "action='{$form->getAction()}' " : '';
        $html .= $form->getMethod() ? "method='{$form->getMethod()}'" : '';
        $html .= $form->getEncodingType() ? "enctype='{$form->getEncodingType()}'" : '';
        $html .= '>';

        // Build the fields.
        foreach ($fields as $field) {
            if (!($field instanceof Field)) {
                throw new \Exception('This is not a valid field!');
            }

            // echo "<pre>";
            // print_r($field->getConditionalLogic());
            // echo "</pre>";

            // Build single field.
            $html .= '<div class="field-row field';
            $html .= FieldClasses::fieldWidthExists($field->getWidth()) ? ' ' . FieldClasses::getWidthClass($field->getWidth()) : '';
            $html .= $field->getConditionalLogic() ? ' hidden' : '';
            $html .= '">';
                $html .= $field->hasLabel() ? '<label for="' . $field->getId() . '">'. $field->getLabel() .'</label>' : '';
                $html .= parent::dispatchField($field);
            $html .= '</div>';

        }

        // Close the form.
        $html .= '</form>';

        $html .= '</div>';

        // Show the form.
        echo $html;
    }

    /**
     * Call static method "build" only.
     */
    public static function __callStatic($method, $args) {
        if ( 'build' === $method ) {
            return call_user_func_array(
                [self::class, $method],
                $args
            );
        } else {
            throw new \Exception('You cannot call other functions over "build".');
        }
    }
}