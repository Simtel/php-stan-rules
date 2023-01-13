<?php

declare(strict_types=1);

use App\Rule\CommandClassShouldBeHelpCommandHandlerClass;
use PHPStan\PhpDocParser\Lexer\Lexer;
use PHPStan\PhpDocParser\Parser\ConstExprParser;
use PHPStan\PhpDocParser\Parser\PhpDocParser;
use PHPStan\PhpDocParser\Parser\TypeParser;
use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;

class CommandClassShouldBeHelpCommandHandlerClassTest extends RuleTestCase
{

    /**
     * @inheritDoc
     */
    protected function getRule(): Rule
    {
        return new CommandClassShouldBeHelpCommandHandlerClass(
            new PhpDocParser(new TypeParser(), new ConstExprParser()),
            new Lexer()
        );
    }

    public function testRule(): void
    {
        $this->analyse([__DIR__ . '../../../src/Examples/TestClassCommand.php'], [
            [
                'PhpDoc command class should be include @see attribute with CommandHandler class name, but include TestClassCommand',
                10
            ]
        ]);
        self::assertTrue(true);
    }
}
