<?php

declare(strict_types=1);

namespace Simtel\PHPStanRules\Tests\Fixture\Return;

class MethodsWithTypeHintAndReturn
{
    /**
     * @return bool
     */
    public function someMethod(): bool
    {
        return true;
    }
}
