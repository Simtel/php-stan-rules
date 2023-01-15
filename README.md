# Extended php-stan-rules
[![License](https://poser.pugx.org/phpstan/phpstan-strict-rules/license)](https://packagist.org/packages/phpstan/phpstan-strict-rules)

### Add new rules:
 - If class name include `Command`, php doc attribute `@see` should be include class with `CommandHandler` in name


## Installation

To use this extension, require it in [Composer](https://getcomposer.org/):

```
composer require --dev simtel/phpstan-rules
```

Add rule to configiration:

```
rules:
    - Simtel\PHPStanRules\Rule\CommandClassShouldBeHelpCommandHandlerClass
```
