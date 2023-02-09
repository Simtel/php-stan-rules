<?php

declare(strict_types=1);

namespace Simtel\PHPStanRules\Rule;

use PhpParser\Node;
use PhpParser\Node\Stmt\Class_;
use PHPStan\Analyser\Scope;
use PHPStan\PhpDocParser\Ast\PhpDoc\ReturnTagValueNode;
use PHPStan\PhpDocParser\Lexer\Lexer;
use PHPStan\PhpDocParser\Parser\PhpDocParser;
use PHPStan\PhpDocParser\Parser\TokenIterator;
use PHPStan\Reflection\ReflectionProvider;
use PHPStan\Rules\Rule;

/**
 * @implements Rule<Class_>
 */
final class NotShouldPhpdocReturnIfExistTypeHint implements Rule
{

    public function __construct(
        private readonly ReflectionProvider $reflectionProvider,
        private readonly PhpDocParser $parser,
        private readonly Lexer $phpDocLexer,
    ) {
    }

    public function getNodeType(): string
    {
        return Class_::class;
    }

    public function processNode(Node $node, Scope $scope): array
    {
        $fullyQualifiedClassName = $node->namespacedName?->toString();
        if ($fullyQualifiedClassName === null) {
            return [];
        }

        $reflection = $this->reflectionProvider
            ->getClass($fullyQualifiedClassName)
            ->getNativeReflection();

        $methods = $reflection->getMethods();

        foreach ($methods as $method) {
            $returnType = $method->getReturnType()?->getName();
            $doc = (string)$method->getDocComment();

            $tokens = new TokenIterator($this->phpDocLexer->tokenize($doc));
            $text = $this->parser->parse($tokens);
            foreach ($text->getTags() as $tag) {
                if ($tag->name !== '@return') {
                    continue;
                }
                if ($tag->value instanceof ReturnTagValueNode) {
                    $value = $tag->value->type->name;
                    if ($value === $returnType) {
                        return ['PhpDoc attribute @return can be remove'];
                    }
                }
            }
        }
        return [];
    }
}
