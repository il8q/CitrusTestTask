<?php
namespace Src\DomainModel\AutorizationContext;

use Src\DomainModel\UniversalContext\DatabaseManagerInterface;

class AutorizationCheckAgregate
{
    public DatabaseManagerInterface $database;
    public function __construct()
    {}
    
}

