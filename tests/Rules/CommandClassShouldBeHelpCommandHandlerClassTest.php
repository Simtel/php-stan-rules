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

    public function testCorrectSeeAttribute(): void
    {
        $this->analyse([__DIR__ . '/../data/command_handler_data1.php'], [
            [
                'PhpDoc command class should be include @see attribute with CommandHandler class name, but include TestClassCommand',
                10
            ]
        ]);
        self::assertTrue(true);
    }

    public function testExistsSeeAttribute(): void
    {
        $this->analyse([__DIR__ . '/../data/command_handler_data2.php'], [
            [
                'PhpDoc command class should be include @see attribute with CommandHandler class name',
                10
            ]
        ]);
        self::assertTrue(true);
    }

    public function testExistsPhpDoc(): void
    {
        $this->analyse([__DIR__ . '/../data/command_handler_data3.php'], [
            [
                'Command class should be include phpDoc with @see attribute',
                7
            ]
        ]);
        self::assertTrue(true);
    }
}
