<?php

declare(strict_types=1);

namespace Simtel\PHPStanRules\Rule;

use PhpParser\Builder\Class_;
use PhpParser\Builder\Method;
use PhpParser\Node;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;

class NotShouldPhpdocReturnIfExistTypeHint implements Rule
{

    public function getNodeType(): string
    {
        return Method::class;
    }

    public function processNode(Node $node, Scope $scope): array
    {
        $methods = $node->getDocComment();
        return [];
    }
}
