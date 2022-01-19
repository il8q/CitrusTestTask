<?php
namespace Src\DomainModel;

use Src\DomainModel\AutorizationContext\AutorizationContext;
use Src\DomainModel\AutorizationContext\AutorizationContextBuilderDirector;
use Src\DomainModel\UniversalContext\DatabaseManagerInterface;

class DomainModelBuilder
{
    private AutorizationContextBuilderDirector $builder;
    private DatabaseManagerInterface $database;
    public function __construct(DatabaseManagerInterface $database)
    {
        $this->builder = new AutorizationContextBuilderDirector($database);
    }
    
    public function createDomainModel(): DomainModel
    {
        return new DomainModel();
    }
    
    public function createAutorizationContext(): AutorizationContext
    {
        return $this->builder->create();
    }
}

