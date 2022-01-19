<?php
namespace Src\DomainModel\UniversalContext;

use Exception;

trait CanApply
{
    private $typePackage;
    private $sendTo;
    
    public function __construct($typePackage, $sendTo)
    {
        $this->typePackage = $typePackage;
        $this->sendTo = $sendTo;
    }
    
    protected function apply($package)
    {
        throw new Exception('Not implemented. Implement in heir.');
    }
}

