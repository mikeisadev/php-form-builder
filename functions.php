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
        Field::make('checkbox', 'select-name', 'Seleziona personaggi', true)
            ->setWidth(33, '%')
            ->setOptions([
                'michele' => 'Michele',
                'francesco' => 'Francesco'
            ]),
        Field::make('text', 'name', 'label')
            ->setWidth(33, '%')
            ->setPlaceholder('dj'),
        Field::make('textarea', 'message', 'Il tuo messaggio')
            ->setWidth(33, '%')
            ->setPlaceholder('fuck')
            ->setCols(50)
            ->setRows(20),
        Field::make('radio', 'my-radio', 'Seleziona un\'opzione')
            ->setWidth(33, '%')
            ->setOptions([
                'option1' => 'Opzione 1',
                'option2' => 'Opzione2'
            ]),
        Field::make('email', 'email', 'Your email')
            ->setConditionalLogic([
                [
                    'field' => 'my-radio',
                    'compare' => '=',
                    'value' => 'option1'
                ]
            ]),
        Field::make('color', 'yourFavouriteColor', 'Your color')
            ->setValue('#000ccc')
            ->setConditionalLogic([
                'relation' => 'OR',
                [
                    'field' => 'select-name',
                    'compare' => '=',
                    'value' => 'michele'
                ],
                [
                    'field' => 'select-name',
                    'compare' => '=',
                    'value' => 'francesco'
                ],
                [
                    'field' => 'random',
                    'compare' => '<=',
                    'value' => '10'
                ]
            ]),
        Field::make('date', 'start-date', 'Select a start date')
            ->setValue('2027-04-27'),
        Field::make('datetime', 'start-datetime', 'Select a start date and time')
            ->setValue('2027-04-27T14:30:00'),
        Field::make('week', 'start-datetime', 'Select a start date and time')
            ->setWidth(50, '%'),
        Field::make('time', 'start-datetime', 'Select a start date and time')
            ->setWidth(50, '%'),
        Field::make('month', 'start-datetime', 'Select a start date and time'),
        Field::make('reset', 'reset'),
        Field::make('search', 'reset')
            ->setWidth(50, '%')
            ->setPlaceholder('Search something...'),
        Field::make('number', 'random')
            ->setWidth(50, '%')
            ->setPlaceholder('Select a number'),
        Field::make('file', 'attachments')
            ->setWidth(50, '%')
            ->setAcceptedExts([
                'application/pdf'
            ]),
        Field::make('url', 'your-website', 'Insert your website url'),
        Field::make('range', 'range', 'Select a range')
            ->setWidth(50, '%'),
        Field::make('hidden', 'csrf-token', 'Hhdh')
            ->setValue(bin2hex(random_bytes(5))),
        Field::make('submit', 'rg')
            ->setValue('Submit form')
    ]);

$form2 = Form::make('contact-me-form', 'Choose contact')
        ->setDescription('Compile this form and you\'ll be recontacted!')
        ->setMethod('POST')
        ->setAction('/')
        ->setWidth(50, '%')
        ->setEncodingType('multipart/form-data')
        ->addFields([
            Field::make('radio', 'chose-modal', 'Test checkbox')
                ->setOptions([
                    'view-email' => 'Via email',
                    'view-phone' => 'Via phone'
                ]),
            Field::make('email', 'user-email', 'Email address')
                ->setConditionalLogic([
                    [
                        'field' => 'chose-modal',
                        'value' => 'view-email',
                        'compare' => '='
                    ]
                ]),
            Field::make('tel', 'user-phone', 'Phone number')
                ->setConditionalLogic([
                    [
                        'field' => 'chose-modal',
                        'value' => 'view-phone',
                        'compare' => '='
                    ]
                ])
        ]);

return [$form1, $form2];