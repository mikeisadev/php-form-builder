<?php
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
    use App\FormBuilder\FormConfig;
    FormConfig::loadAssets([$form1, $form2, $form3, $form4], ['theme' => 'bootstrap']);
    ?>
</head>
<body>