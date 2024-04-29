<?php

namespace App\FormBuilder;

class FieldClasses {

    /**
     * Field witdths that can be converted into HTML classes.
     */
    private static array $fieldWidths = [
        '10%'   => 'col-10',
        '20%'   => 'col-20',
        '25%'   => 'col-25',
        '33%'   => 'col-33',
        '50%'   => 'col-50',
        '75%'   => 'col-75'
    ];

    /**
     * Get all available field widths.
     */
    public static function getFieldWidths(): array {
        return static::$fieldWidths;
    }

    /**
     * Check if field width exists.
     */
    public static function fieldWidthExists(string $width): bool {
        return array_key_exists($width, static::$fieldWidths);
    }

    /**
     * Get the relative field class for a given value.
     */
    public static function getWidthClass(string $width): string {
        return static::fieldWidthExists($width) ? static::$fieldWidths[$width] : '';
    }

}