<?php

declare(strict_types=1);
namespace Simtel\PHPStanRules\Tests\Fixture\EventListener;

use Simtel\PHPStanRules\Tests\Fixture\EventListener\AsEventListener;

#[AsEventListener]
class TestClassEventListener
{
    public function method():void
    {

    }
}
