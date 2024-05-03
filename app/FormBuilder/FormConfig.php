<?php

namespace App\FormBuilder;

use App\FormBuilder\Form;
use App\FormBuilder\FieldClasses;
use App\Utils\Str;

class FormConfig {

    /**
     * Whitelist of allowed themes.
     */
    private static array $themes = ['bootstrap', 'typewrite', 'minimal'];

    /**
     * Load core assets.
     */
    public static function loadAssets(?array $forms = NULL, ?array $options = NULL) { 
        // Init CSS and JS.
        $css = (string) '';
        $js = (string) '';
        $theme = (string) '';

        // If we have forms build CSS and JS.
        if ($forms) {
            // Init form conditionals for JS.
            $formConditionals = [];
            $formConfig = [];

            foreach ($forms as $form) {
                // Get form id.
                $formId = $form->getId();

                // Get form object step config.
                $stepConfig = $form->getFormStepConfig();

                // START Build form wrap style.
                if ($form->getFormWrapStyle()) {
                    $css .= "#{$formId}__wrap {";
                    foreach ($form->getFormWrapStyle() as $property => $value) {
                        $css .= "{$property}:{$value}";
                    }
                    $css .= '}';
                }
                // END Build form wrap style.

                // START Build form style.
                if ($form->getFormStyle()) {
                    $css .= "#{$formId} {";
                    foreach ($form->getFormStyle() as $property => $value) {
                        $css .= "{$property}:{$value}";
                    }
                    $css .= '}';
                }
                // END Build form style.

                // START Build style PER field.
                foreach ($form->getFields() as $index => $field) {
                    if (!FieldClasses::fieldWidthExists( $field->getWidth() )) {
                        $index = $index + 1;

                        $css .= "#{$formId} .field-row:nth-child(-{$index}n+{$index}) {";
                        $css .= "width: {$field->getWidth()} !important";
                        $css .= '}';
                    }
                }
                // END Build style PER field.
                
                // START Build form conditionals for JS.
                if ( $logic = $form->getFormConditionals() ) {
                    $formConditionals = [...$logic, ...$formConditionals];
                }
                // END Build form conditionals for JS.

                // START Build form config for steps for JS.
                if ( $steps = $form->getFormSteps() ) {
                    $formConfig[] = [
                        'formId'            => '#'.$formId,
                        'initialStep'       => 1,
                        'totalSteps'        => count($steps),
                        'showPercentage'    => $stepConfig['showPercentage']
                    ];
                }
                // END Build form config for steps for JS.
            }
            // Concat form conditionals.
            $js .= 'const formConditionals = '. json_encode($formConditionals) .';';
            $js .= 'const formConfig = '. json_encode($formConfig) .';';
        }

        if ($options) {
            switch(true) {
                case array_key_exists('theme', $options):
                    if ( in_array($options['theme'], static::$themes) ) {
                        $theme = file_get_contents(__DIR__ . '/assets/css/themes/' . $options['theme'] . '.css');
                    }
                    break;
            }
        }
        ?>
        <script id="pfmb-js">
            <?php 
            echo 'window.addEventListener("DOMContentLoaded", () => {';
                echo $js;
                echo file_get_contents(__DIR__ . '/assets/js/steps.js');
                echo file_get_contents(__DIR__ . '/assets/js/conditionals.js');
            echo '});';
            ?>
        </script>
        <style id="pfmb-core-style">
            <?php 
            echo file_get_contents(__DIR__ . '/assets/css/form.css');
            echo $css;
            echo $theme;
            ?>
        </style>
    <?php }

}