<?php

declare(strict_types=1);

namespace data\event_listener;

use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener]
class TestClassEventListener
{
    public function method():void
    {

    }
}
