# Extended php-stan-rules
[![License](https://poser.pugx.org/phpstan/phpstan-strict-rules/license)](https://packagist.org/packages/phpstan/phpstan-strict-rules)

### Add new rules:
 - If class name include `Command`, php doc attribute `@see` should be included class with `CommandHandler` in name (if class include invoke method the rule does not apply)
 - If class name ends EventListener, class should be included attribute AsEventListener  

## Installation

To use this extension, require it in [Composer](https://getcomposer.org/):

```
composer require --dev simtel/phpstan-rules
```

Add rule to configuration:

```
rules:
    - Simtel\PHPStanRules\Rule\CommandClassShouldBeHelpCommandHandlerClass
    - Simtel\PHPStanRules\Rule\EventListenerClassShouldBeIncludeAsListenerAttribute
```
