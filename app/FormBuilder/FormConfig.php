<?php

namespace App\FormBuilder;

use App\FormBuilder\Form;
use App\FormBuilder\FieldClasses;
use App\Utils\Str;

class FormConfig {

    /**
     * Load core assets.
     */
    public static function loadAssets(?array $forms = NULL) { ?>
        <script id="pfmb-conditionals">
            <?php 
            if ($forms) {
                $js = '';
                $formConditionals = [];

                foreach ($forms as $form) {
                    $formId = $form->getId();

                    foreach ($form->getFields() as $index => $field) {
                        $logic = $field->getConditionalLogic();

                        if ($logic) {
                            $index = $index + 1;

                            $logic['formId'] = $formId;
                            $logic['targetFieldSel'] = '#'.$formId.' .field-row:nth-child(-'.$index.'n+'.$index.')';

                            $formConditionals[] = $logic;
                        }
                    }
                }
                $js .= 'const formConditionals = '. json_encode($formConditionals) .';';

                echo $js;
            }

            echo file_get_contents(__DIR__ . '/assets/js/conditionals.js');
            ?>
        </script>
        <script id="pfmb-steps"><?= file_get_contents(__DIR__ . '/assets/js/steps.js'); ?></script>
        <style id="pfmb-core-style">
            <?php 
            echo file_get_contents(__DIR__ . '/assets/css/form.css');

            if ($forms) {
                $css = (string) '';

                foreach ($forms as $form) {
                    $formId = $form->getId();

                    // START Build form style.
                    $css .= "#{$formId} {";
                    foreach ($form->getFormStyle() as $property => $value) {
                        $css .= "{$property}:{$value}";
                    }
                    $css .= '}';
                    // END Build form style.

                    // START Build style PER field.
                    $css .= '';
                    foreach ($form->getFields() as $index => $field) {
                        if (!FieldClasses::fieldWidthExists( $field->getWidth() )) {
                            $index = $index + 1;

                            $css .= "#{$formId} .field-row:nth-child(-{$index}n+{$index}) {";
                            $css .= "width: {$field->getWidth()} !important";
                            $css .= '}';
                        }
                    }
                    // END Build style PER field.

                    echo $css;
                }
            }
            ?>
        </style>
    <?php }

}