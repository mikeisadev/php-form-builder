<?php

use App\FormBuilder\Form;
use App\FormBuilder\Field;

$form1 = Form::make('another-form', 'Contact me')
    ->setDescription('Compile this form and you\'ll be recontacted!')
    ->setMethod('POST')
    ->setAction('/')
    ->setWidth(50, '%')
    ->setEncodingType('multipart/form-data')
    ->addFields([
        Field::make('checkbox', 'name', 'Seleziona personaggi', true)
            ->setWidth(33, '%')
            ->setOptions([
                'michele' => 'Michele',
                'francesco' => 'Francesco'
            ]),
        Field::make('text', 'name', 'label')
            ->setWidth(33, '%')
            ->setPlaceholder('dj'),
        Field::make('textarea', 'd', 'Il tuo messaggio')
            ->setWidth(33, '%')
            ->setPlaceholder('fuck')
            ->setCols(50)
            ->setRows(20),
        Field::make('radio', 'my-radio', 'Seleziona un\'opzione')
            ->setWidth(33, '%')
            ->setOptions([
                'hello' => 'Opzione 1',
                'hello2' => 'Opzione2'
            ]),
        Field::make('email', 'email', 'Your email'),
        Field::make('color', 'yourFavouriteColor', 'Your color')
            ->setValue('#000ccc'),
        Field::make('date', 'start-date', 'Select a start date')
            ->setValue('2027-04-27'),
        Field::make('datetime', 'start-datetime', 'Select a start date and time')
            ->setValue('2027-04-27T14:30:00'),
        Field::make('week', 'start-datetime', 'Select a start date and time'),
        Field::make('time', 'start-datetime', 'Select a start date and time'),
        Field::make('month', 'start-datetime', 'Select a start date and time'),
        Field::make('reset', 'reset'),
        Field::make('search', 'reset')
            ->setPlaceholder('Search something...'),
        Field::make('number', 'random')
            ->setPlaceholder('Select a number'),
        Field::make('file', 'attachments')
            ->setAcceptedExts([
                'application/pdf'
            ]),
        Field::make('url', 'your-website', 'Insert your website url'),
        Field::make('range', 'range', 'Select a range'),
        Field::make('hidden', 'csrf-token', 'Hhdh')
            ->setValue(bin2hex(random_bytes(5))),
        Field::make('submit', 'rg')
            ->setValue('Submit form')
    ]);

return $form1;