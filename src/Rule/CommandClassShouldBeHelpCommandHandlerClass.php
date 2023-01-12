<?php

declare(strict_types=1);

namespace App\Rule;

use PhpParser\Node;
use PhpParser\Node\Stmt\Class_;
use PHPStan\Analyser\Scope;
use PHPStan\PhpDocParser\Ast\PhpDoc\GenericTagValueNode;
use PHPStan\PhpDocParser\Lexer\Lexer;
use PHPStan\PhpDocParser\Parser\PhpDocParser;
use PHPStan\PhpDocParser\Parser\TokenIterator;
use PHPStan\Rules\Rule;

class CommandClassShouldBeHelpCommandHandlerClass implements Rule
{

    public function __construct(
        private readonly PhpDocParser $parser,
        private readonly Lexer $phpDocLexer,
    ) {
    }

    public function getNodeType(): string
    {
        return Class_::class;
    }

    /**
     * @param Class_ $node
     * @param Scope $scope
     * @return string[]
     */
    public function processNode(Node $node, Scope $scope): array
    {
        $className = '';
        if ($node->name !== null) {
            $className = $node->name->name;
        }

        if (!str_ends_with($className, 'Command')) {
            return [];
        }

        $find = false;
        $doc = $node->getDocComment()?->getText() ?? '';
        $tokens = new TokenIterator($this->phpDocLexer->tokenize($doc));
        $text = $this->parser->parse($tokens);

        foreach ($text->getTags() as $tag) {
            if ($tag->name !== '@see') {
                continue;
            }
            if ($tag->value instanceof GenericTagValueNode) {
                $find = true;
                $value = $tag->value->value;
                if (!str_ends_with($value, 'CommandHandler')) {
                    return [
                        sprintf(
                            'PhpDoc command class should be include @see attribute with CommandHandler class name, but include %s',
                            $value
                        ),
                    ];
                }
            }
        }
        if ($find === false) {
            return [
                'PhpDoc command class should be include @see attribute with CommandHandler class name',
            ];
        }

        return [];
    }

}
