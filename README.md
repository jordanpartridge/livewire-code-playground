# Livewire Code Playground

A Livewire-powered code playground component for Laravel applications.

## Features

- Live code editing with syntax highlighting
- Secure code execution
- Support for PHP, JavaScript, and HTML
- Real-time output display
- Configurable editor settings
- Sandboxed execution environment

## Installation

You can install the package via composer:

```bash
composer require jordanpartridge/livewire-code-playground
```

## Usage

```php
<livewire:code-playground />

// Or with initial code
<livewire:code-playground initial-code="<?php\n\necho 'Hello World!';" />
```

## Security

- Execution timeout limits
- Memory restrictions
- Sandboxed environment
- Input validation

## Testing

```bash
composer test
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.