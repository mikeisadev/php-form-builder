<?php

namespace App\Utils;

class Str {

    /**
     * Generate a random string.
     */
    public static function random(?string $prefix = NULL, int $length = 15): string {
        return substr( ($prefix ? $prefix : 0) . bin2hex( random_bytes(50) ), 0, $length );
    }

}