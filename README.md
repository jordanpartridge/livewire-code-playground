# Livewire Code Playground

A Livewire-powered code playground component for Laravel applications that provides real-time code editing and execution capabilities.

## Features

- Live code editing with syntax highlighting via CodeMirror
- Support for multiple languages:
  - PHP
  - JavaScript
  - HTML
- Real-time code updates
- Configurable editor settings
- Secure code execution environment
- Customizable security settings

## Requirements

- PHP ^8.2
- Laravel Framework ^10.0|^11.0
- Livewire ^3.0

## Installation

You can install the package via composer:

```bash
composer require jordanpartridge/livewire-code-playground
```

The package will automatically register its service provider.

## Publishing Resources

Publish the configuration file:

```bash
php artisan vendor:publish --tag="livewire-code-playground-config"
```

Optionally, you can publish the views:

```bash
php artisan vendor:publish --tag="livewire-code-playground-views"
```

And assets:

```bash
php artisan vendor:publish --tag="livewire-code-playground-assets"
```

## Usage

Add the Livewire component to your blade view:

```php
<livewire:code-playground />
```

With initial code:

```php
<livewire:code-playground 
    initial-code="<?php\n\necho 'Hello World!';" 
    language="php"
/>
```

## Configuration

### Editor Settings

```php
// config/code-playground.php

'editor' => [
    'theme' => 'monokai',
    'font_size' => 14,
    'tab_size' => 4,
    'line_numbers' => true,
    'line_wrapping' => true,
    'auto_close_brackets' => true,
    'match_brackets' => true,
],
```

### Execution Settings

```php
'execution' => [
    'timeout' => 5, // Maximum execution time in seconds
    'memory_limit' => '128M', // Maximum memory allocation
    'allowed_languages' => ['php', 'javascript', 'html'],
],
```

### Security Settings

```php
'security' => [
    'allowed_functions' => [
        'array_map',
        'array_filter',
        'array_reduce',
        // Add more as needed
    ],
    'forbidden_functions' => [
        'exec',
        'shell_exec',
        'system',
        'passthru',
        'eval',
        // Add more as needed
    ],
],
```

## Events

The component emits and listens to the following Livewire events:

- `executeCode` - Triggered when running code
- `updateCode` - Triggered when code content changes
- `languageChanged` - Triggered when selected language changes

## Security

The package implements several security measures:

- Input validation
- Configurable execution timeouts
- Memory usage limits
- Function whitelisting/blacklisting
- Sandboxed execution environment

## Testing

```bash
composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Jordan Partridge](https://github.com/jordanpartridge)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
