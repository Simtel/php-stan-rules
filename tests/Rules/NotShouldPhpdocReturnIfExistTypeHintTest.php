<?php

declare(strict_types=1);

namespace Simtel\PHPStanRules\Tests\Rules;

use PHPStan\PhpDocParser\Lexer\Lexer;
use PHPStan\PhpDocParser\Parser\ConstExprParser;
use PHPStan\PhpDocParser\Parser\PhpDocParser;
use PHPStan\PhpDocParser\Parser\TypeParser;
use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;
use Simtel\PHPStanRules\Rule\NotShouldPhpdocReturnIfExistTypeHint;

class NotShouldPhpdocReturnIfExistTypeHintTest extends RuleTestCase
{

    /**
     * @inheritDoc
     */
    protected function getRule(): Rule
    {
        return new NotShouldPhpdocReturnIfExistTypeHint(
            $this->createReflectionProvider(),
            new PhpDocParser(new TypeParser(), new ConstExprParser()),
            new Lexer()
        );
    }

    public function testWithError(): void
    {
        $this->analyse([__DIR__ . '/../Fixture/Return/MethodsWithTypeHintAndReturn.php'], [
            [
                'PhpDoc attribute @return for method someMethod can be remove',
                7
            ]
        ]);
    }
}
