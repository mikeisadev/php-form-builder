<?php

use App\FormBuilder\Form;
use App\FormBuilder\Field;

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

// Form 1.
$form1 = Form::make('another-form', 'Contact me')
    ->setDescription('Compile this form and you\'ll be recontacted!')
    ->setMethod('POST')
    ->setAction('/')
    ->setWidth(50, '%')
    ->setEncodingType('multipart/form-data')
    ->addFields([
        Field::make('image', 'button-image', 'Button image test')
            ->setAttribute('src', 'hejffiej')
            ->setAttribute('alt', 'Alttag!'),
        Field::make('checkbox', 'select-name', 'Seleziona personaggi')
            ->setWidth(33, '%')
            ->setOptions([
                'michele' => ['value' => 'Michele', 'checked' => true],
                'francesco' => ['Francesco', true]
            ]),
        Field::make('text', 'name', 'label')
            ->setWidth(33, '%')
            ->setAttribute('placeholder', 'dj'),
        Field::make('textarea', 'message', 'Il tuo messaggio')
            ->setWidth(33, '%')
            ->setAttribute('placeholder', 'fuck')
            ->setAttribute('rows', 20)
            ->setAttribute('cols', 50)
            ->setAttribute('disabled', true),
        Field::make('radio', 'my-radio', 'Seleziona un\'opzione')
            ->setWidth(33, '%')
            ->setOptions([
                'option1' => ['Opzione 1'],
                'option2' => ['Opzione2', true]
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
            ->setAttribute('value', '#000ccc')
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
            ->setAttribute('value','2027-04-27'),
        Field::make('datetime', 'start-datetime', 'Select a start date and time')
            ->setAttribute('value', '2027-04-27T14:30:00'),
        Field::make('week', 'start-datetime', 'Select a start date and time')
            ->setWidth(50, '%'),
        Field::make('time', 'start-datetime', 'Select a start date and time')
            ->setWidth(50, '%'),
        Field::make('month', 'start-datetime', 'Select a start date and time'),
        Field::make('reset', 'reset'),
        Field::make('search', 'reset')
            ->setWidth(50, '%')
            ->setAttribute('placeholder', 'Search something...'),
        Field::make('number', 'random')
            ->setWidth(50, '%')
            ->setAttribute('placeholder', 'Select a number'),
        Field::make('file', 'attachments')
            ->setWidth(50, '%')
            ->setAttribute('accept', 'application/pdf'),
        Field::make('url', 'your-website', 'Insert your website url'),
        Field::make('range', 'range', 'Select a range')
            ->setWidth(50, '%')
            ->setAttribute('step', 10)
            ->setAttribute('min', 0)
            ->setAttribute('max', 50),
        Field::make('hidden', 'csrf-token')
            ->setAttribute('value', bin2hex(random_bytes(5))),
        Field::make('submit', 'rg')
            ->setAttribute('value', 'Submit form')
    ]);

// Form 2.
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

// Form 3.
$form3 = Form::make('contact-me-form-stepp', 'Choose contact')
    ->setDescription('Compile this form and you\'ll be recontacted!')
    ->setMethod('POST')
    ->setAction('/')
    ->setWidth(50, '%')
    ->setEncodingType('multipart/form-data')
    ->addStep([
        Field::make('text', 'fname', 'Il tuo nome'),
        Field::make('text', 'lname', 'Il tuo cognome')
    ])
    ->addStep([
        Field::make('email', 'email-address', 'Il tuo indirizzo email'),
        Field::make('tel', 'phone-number', 'Il tuo numero di telefono'),
        Field::make('number', 'choose-number', 'Un numero a caso')
    ])
    ->addStep([
        Field::make('color', 'user-color', 'Scegli un colore!')
    ]);

// Form 3.
$form4 = Form::make('second-step-form', 'Choose contact')
    ->setDescription('Compile this form and you\'ll be recontacted!')
    ->setMethod('POST')
    ->setAction('/')
    ->setWrapWidth(50, '%')
    ->setWidth(100, '%')
    ->setEncodingType('multipart/form-data')
    ->showProgressBar(true)
    ->showIndex(true)
    ->showPercentage(false)
    ->addStep([
        Field::make('checkbox', 'acceptance', 'Accetto la privacy policy di questo sito'),
        Field::make('checkbox', 'greet', 'Seleziona un saluto')
            ->setOptions([
                'g' => 'Giao',
                'c' => 'Ciao'
            ]),
        Field::make('text', 'fname', 'Il tuo nome')
            ->setConditionalLogic([
                [
                    'field' => 'acceptance',
                    'value' => true
                ]
            ]),
        Field::make('text', 'lname', 'Il tuo cognome')
            ->setConditionalLogic([
                'relation' => 'AND',
                [
                    'field' => 'greet',
                    'compare' => '=',
                    'value' => 'g'
                ],
                [
                    'field' => 'greet',
                    'compare' => '=',
                    'value' => 'c'
                ]
            ])
    ])
    ->addStep([
        Field::make('email', 'email-address', 'Il tuo indirizzo email'),
        Field::make('tel', 'phone-number', 'Il tuo numero di telefono'),
        Field::make('number', 'choose-number', 'Un numero a caso')
    ])
    ->addStep([
        Field::make('color', 'user-color', 'Scegli un colore!')
    ])
    ->addStep([
        Field::make('text', 'fname', 'Il tuo nome'),
        Field::make('text', 'lname', 'Il tuo cognome')
    ])
    ->addStep([
        Field::make('email', 'email-address', 'Il tuo indirizzo email'),
        Field::make('tel', 'phone-number', 'Il tuo numero di telefono'),
        Field::make('number', 'choose-number', 'Un numero a caso')
    ])
    ->addStep([
        Field::make('color', 'user-color-1', 'Scegli un colore!'),
        Field::make('select', 'favourite-flavour', 'La tua fragranza preferita')
            ->setWidth(50, '%')
            ->setOptions([
                'lemon' => 'Limone',
                'peach' => 'Pesca'
            ])
            ->setConditionalLogic([
                [
                    'field' => 'user-color-1',
                    'compare' => '=',
                    'value' => '#ffffff'
                ] 
            ]),
        Field::make('text', 'user-agent-name', 'Nome dell\'user agent')
            ->setConditionalLogic([
                [
                    'field' => 'favourite-flavour',
                    'compare' => '=',
                    'value' => 'peach'
                ]
            ]),
        Field::make('reset', 'Reset all!')
    ])
    ->addStep([
        Field::make('paragraph', 'info-text', 'Clicca il pulsante qui sotto per inviare il tuo modulo'),
        Field::make('submit', 'submit-form', 'Invia!')
    ]);

return [$form1, $form2, $form3, $form4];