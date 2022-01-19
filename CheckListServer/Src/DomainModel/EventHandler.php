<?php
namespace Src\DomainModel;

use Src\DomainModel\UniversalContext\CanApply;
use Exception;

class EventHandler
{
    use CanApply;
    private function apply($package)
    {
        throw new Exception('Not implemented');
    }
}

