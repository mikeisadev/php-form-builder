# PHP FormBuilder Library

A flexible and powerful PHP library for creating HTML forms with advanced features including conditional logic, multi-step forms, and various input types.

## Note
This is not a production ready library to build forms. It is a work in progress and is not yet fully functional. The code is provided for educational purposes and to demonstrate the concept of a form builder in PHP.

## Table of Contents

- [Installation](#installation)
- [Basic Usage](#basic-usage)
- [Form Class](#form-class)
  - [Creating a Form](#creating-a-form)
  - [Form Methods](#form-methods)
  - [Multi-step Forms](#multi-step-forms)
- [Field Class](#field-class)
  - [Creating Fields](#creating-fields)
  - [Field Methods](#field-methods)
  - [Available Field Types](#available-field-types)
  - [Conditional Logic](#conditional-logic)
- [Examples](#examples)
  - [Basic Form](#basic-form)
  - [Contact Form with Conditional Fields](#contact-form-with-conditional-fields)
  - [Multi-step Form](#multi-step-form)

## Installation

Download or clone this repository.

Then include "bootstrap.php" in your project to test this form builder.

## Basic Usage

```php
use App\FormBuilder\Form;
use App\FormBuilder\Field;

// Create a simple form
$form = Form::make('contact-form', 'Contact Us')
    ->setMethod('POST')
    ->setAction('/submit')
    ->addFields([
        Field::make('text', 'name', 'Your Name'),
        Field::make('email', 'email', 'Your Email'),
        Field::make('textarea', 'message', 'Your Message'),
        Field::make('submit', 'submit', 'Send Message')
    ]);
```

## Form Class

### Creating a Form

```php
Form::make(string $id, string $title = '')
```

Parameters:
- `$id` - Unique identifier for the form
- `$title` - Optional form title

### Form Methods

| Method | Description |
|--------|-------------|
| `setDescription(string $description)` | Sets the form description |
| `setMethod(string $method)` | Sets the HTTP method (GET/POST) |
| `setAction(string $url)` | Sets the form action URL |
| `setWidth(int $width, string $unit = 'px')` | Sets the form width |
| `setWrapWidth(int $width, string $unit = 'px')` | Sets the form wrapper width |
| `setEncodingType(string $type)` | Sets the encoding type (e.g., 'multipart/form-data') |
| `addFields(array $fields)` | Adds an array of field objects |

### Multi-step Forms

Multi-step forms allow you to organize fields into sequential steps:

```php
$form->addStep([
    Field::make('text', 'fname', 'First Name'),
    Field::make('text', 'lname', 'Last Name')
])->addStep([
    Field::make('email', 'email', 'Email Address')
]);
```

Step control methods:
- `showProgressBar(bool $show)` - Shows/hides the progress bar
- `showIndex(bool $show)` - Shows/hides the step index
- `showPercentage(bool $show)` - Shows/hides completion percentage

## Field Class

### Creating Fields

```php
Field::make(string $type, string $name, string $label = '')
```

Parameters:
- `$type` - Field type (see available types below)
- `$name` - Name attribute for the field
- `$label` - Optional label text

### Field Methods

| Method | Description |
|--------|-------------|
| `setWidth(int $width, string $unit = 'px')` | Sets the field width |
| `setAttribute(string $name, $value)` | Sets an HTML attribute on the field |
| `setOptions(array $options)` | Sets options for select, checkbox, and radio fields |
| `setConditionalLogic(array $conditions)` | Sets conditions for when this field should be shown |

### Available Field Types

| Type | Description |
|------|-------------|
| `text` | Text input |
| `textarea` | Multiline text area |
| `email` | Email address input |
| `password` | Password input |
| `number` | Numeric input |
| `tel` | Telephone number input |
| `url` | URL input |
| `color` | Color picker |
| `date` | Date picker |
| `datetime` | Date and time picker |
| `month` | Month picker |
| `week` | Week picker |
| `time` | Time picker |
| `select` | Dropdown select |
| `checkbox` | Checkbox input |
| `radio` | Radio button input |
| `file` | File upload input |
| `range` | Range slider |
| `hidden` | Hidden input |
| `search` | Search input |
| `image` | Image button |
| `submit` | Submit button |
| `reset` | Reset button |
| `paragraph` | Text paragraph (non-input) |

### Conditional Logic

Conditional logic allows you to show or hide fields based on the values of other fields:

```php
Field::make('email', 'email', 'Email Address')
    ->setConditionalLogic([
        [
            'field' => 'contact-method',
            'compare' => '=',
            'value' => 'email'
        ]
    ])
```

You can use multiple conditions with AND/OR relations:

```php
->setConditionalLogic([
    'relation' => 'OR',  // Default is 'AND'
    [
        'field' => 'field1',
        'compare' => '=',
        'value' => 'value1'
    ],
    [
        'field' => 'field2',
        'compare' => '>=',
        'value' => 'value2'
    ]
])
```

Available comparison operators:
- `=` - Equal to
- `!=` - Not equal to
- `>` - Greater than
- `<` - Less than
- `>=` - Greater than or equal to
- `<=` - Less than or equal to

## Examples

### Basic Form

```php
$form = Form::make('contact-form', 'Contact Us')
    ->setDescription('Please fill out this form to contact us')
    ->setMethod('POST')
    ->setAction('/submit')
    ->setWidth(50, '%')
    ->setEncodingType('multipart/form-data')
    ->addFields([
        Field::make('text', 'name', 'Your Name')
            ->setAttribute('placeholder', 'John Doe'),
        Field::make('email', 'email', 'Your Email')
            ->setAttribute('placeholder', 'john@example.com'),
        Field::make('textarea', 'message', 'Your Message')
            ->setAttribute('rows', 5),
        Field::make('submit', 'submit')
            ->setAttribute('value', 'Send Message')
    ]);
```

### Contact Form with Conditional Fields

```php
$form = Form::make('contact-me-form', 'Choose Contact Method')
    ->setMethod('POST')
    ->setAction('/')
    ->addFields([
        Field::make('radio', 'contact-method', 'Preferred contact method')
            ->setOptions([
                'email' => 'Via email',
                'phone' => 'Via phone'
            ]),
        Field::make('email', 'user-email', 'Email address')
            ->setConditionalLogic([
                [
                    'field' => 'contact-method',
                    'value' => 'email',
                    'compare' => '='
                ]
            ]),
        Field::make('tel', 'user-phone', 'Phone number')
            ->setConditionalLogic([
                [
                    'field' => 'contact-method',
                    'value' => 'phone',
                    'compare' => '='
                ]
            ]),
        Field::make('submit', 'submit', 'Send')
    ]);
```

### Multi-step Form

```php
$form = Form::make('registration-form', 'User Registration')
    ->setMethod('POST')
    ->setAction('/register')
    ->setWidth(100, '%')
    ->showProgressBar(true)
    ->showIndex(true)
    ->addStep([
        Field::make('text', 'fname', 'First Name'),
        Field::make('text', 'lname', 'Last Name')
    ])
    ->addStep([
        Field::make('email', 'email', 'Email Address'),
        Field::make('tel', 'phone', 'Phone Number')
    ])
    ->addStep([
        Field::make('password', 'password', 'Choose Password'),
        Field::make('password', 'confirm_password', 'Confirm Password')
    ])
    ->addStep([
        Field::make('checkbox', 'terms', 'I agree to the terms and conditions'),
        Field::make('submit', 'register', 'Complete Registration')
    ]);
```
