<?php

use App\FormBuilder\Form;
use App\FormBuilder\Field;

require __DIR__ . '/bootstrap.php';
require __DIR__ . '/functions.php';
require __DIR__ . '/header.php';

$form1->build();
$form2->build();

require __DIR__ . '/footer.php';