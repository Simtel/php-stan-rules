<?php

declare(strict_types=1);

namespace Simtel\PHPStanRules\Tests\Rules;

use PhpParser\Builder\Class_;
use PhpParser\Node;
use PHPStan\Analyser\Scope;
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
        return new NotShouldPhpdocReturnIfExistTypeHint();
    }

    public function testWithError(): void
    {
        $this->analyse([__DIR__ . '/../Fixture/Return/MethodsWithTypeHintAndReturn.php'], [
            [
                'Event listener class should be include attribute #[AsEventListener]',
                7
            ]
        ]);
    }
}
