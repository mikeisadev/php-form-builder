<?php

use Dotenv\Dotenv;

// Autoload all vendor and /app classes.
require __DIR__ . '/vendor/autoload.php';

// Load environmental classes.
Dotenv::createImmutable( __DIR__ )->load();