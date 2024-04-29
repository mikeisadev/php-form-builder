<?php

namespace App\Utils;

class Assets {

    private static array $allowed = ['js', 'css'];

    // Load a single asset.
    public static function loadAsset(string $type, string $src) {
        if ( !in_array($type, static::$allowed) ) throw new \Exception('This asset type is not valid!');

        switch($type) {
            case 'js':
                echo '<script type="text/javascript" src="' . $src . '"></script>';
                break;
            case 'css':
                echo '<link rel="stylesheet" href="' . $src . '">';
                break;
        }
    }

}