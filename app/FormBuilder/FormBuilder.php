<?php

namespace App\FormBuilder;

use App\FormBuilder\Form;
use App\FormBuilder\Field;
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

        // Get fields.
        $fields = $form->getFields();

        // Get form steps.
        $formSteps = $form->getFormSteps();

        // Form step config.
        $formStepConfig = null;

        // Build form wrap.
        $html = '<div class="pfmb-form-wrap" id="'.$form->getId().'__wrap">';

        // Add form title and description.
        if ($form->getTitle()) {
            $html .= '<div class="form-header">';
            $html .= "<h2 class='form-title'>{$form->getTitle()}</h2>";
            $html .= $form->getDescription() ? "<p class='form-description'>{$form->getDescription()}</p>" : '';
            $html .= '</div>';
        }

        // Wrap the form in "form-body" div.
        $html .= '<div class="form-body">';

        if ($formSteps) {
            $formStepConfig = $form->getFormStepConfig();

            if ($formStepConfig['progressBar']) {
                $html .= '<div class="progress-bar-wrap">';
                $html .= '<div class="progress-bar" style="width: 0%;"></div>';
                $html .= '</div>';
            }
        }

        // Start building the form.
        $html .= '<form class="pfmb-form"';
        $html .= $form->getId() ? "id='{$form->getId()}' " : '';
        $html .= $form->getAction() ? "action='{$form->getAction()}' " : '';
        $html .= $form->getMethod() ? "method='{$form->getMethod()}'" : '';
        $html .= $form->getEncodingType() ? "enctype='{$form->getEncodingType()}'" : '';
        $html .= '>';

        // Build the fields if we have them.
        if ($fields) {
            foreach ($fields as $field) {
                $html .= parent::buildFieldRow($field);
            }
        }

        // Build the steps if we have them.
        if ($formSteps) {
            foreach ($formSteps as $index => $step) {
                $html .= '<div class="form-step single-step' . ($index !== 0 ? ' hidden-step' : '') . '">';
                foreach ($step as $field) {
                    $html .= parent::buildFieldRow($field);
                }
                $html .= '</div>';
            }
        }

        // Close the form.
        $html .= '</form>';

        // Build the action bar.
        if ($formSteps) {
            $html .= '<div class="action-bar-wrap">';

            if ( $formStepConfig['stepIndex'] ) {
                $html .= '<div class="form-index">Step <span class="start">1</span> di <span class="end">' . count($formSteps) . '</span></div>';
            }

            $html .= '<div class="actions"><button class="form-back" data-action="back">Indietro</button><button class="form-next" data-action="next">Avanti</button></div>';
            $html .= '</div>';
        }

        // Close the form body container.
        $html .= '</div>';

        // Close the wrap.
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