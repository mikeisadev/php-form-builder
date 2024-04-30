<?php

namespace App\FormBuilder;

use App\FormBuilder\Form;
use App\FormBuilder\FieldClasses;
use App\Utils\Str;

class FormConfig {

    /**
     * Load core assets.
     */
    public static function loadAssets(?array $forms = NULL) { 
        // Init CSS and JS.
        $css = (string) '';
        $js = (string) '';

        // If we have forms build CSS and JS.
        if ($forms) {
            // Init form conditionals for JS.
            $formConditionals = [];

            foreach ($forms as $form) {
                // Get form id.
                $formId = $form->getId();

                // START Build form style.
                $css .= "#{$formId} {";
                foreach ($form->getFormStyle() as $property => $value) {
                    $css .= "{$property}:{$value}";
                }
                $css .= '}';
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
            }

            // Concat form conditionals.
            $js .= 'const formConditionals = '. json_encode($formConditionals) .';';
        }
        ?>
        <script id="pfmb-steps"><?= file_get_contents(__DIR__ . '/assets/js/steps.js'); ?></script>
        <script id="pfmb-conditionals">
            <?php 
            echo $js;
            echo file_get_contents(__DIR__ . '/assets/js/conditionals.js');
            ?>
        </script>
        <style id="pfmb-core-style">
            <?php 
            echo file_get_contents(__DIR__ . '/assets/css/form.css');
            echo $css;
            ?>
        </style>
    <?php }

}