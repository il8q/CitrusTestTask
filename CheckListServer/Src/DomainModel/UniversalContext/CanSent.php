<?php
namespace Src\DomainModel\UniversalContext;

trait CanSent
{
    private $typePackage;
    private $sendTo;
    
    public function __construct($typePackage, $sendTo)
    {
        $this->typePackage = $typePackage;
        $this->sendTo = $sendTo;
    }
    
    protected function sent($package)
    {
        $this->sendTo.apply($package);
    }
}
