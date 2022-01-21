<?php
namespace Src\DomainModel;

use Src\DomainModel\AutorizationContext\AutorizationContext;
use Src\DomainModel\AutorizationContext\AutorizationContextBuilderDirector;
use Src\DomainModel\PresentCheckListContext\PresentCheckListContext;
use Src\DomainModel\PresentCheckListContext\PresentCheckListContextBuilderDirector;
use Src\DomainModel\UniversalContext\DatabaseManagerInterface;

class DomainModelBuilder
{
    private AutorizationContextBuilderDirector $builder;
    private DatabaseManagerInterface $database;
    public function __construct(DatabaseManagerInterface $database)
    {
        $this->autorizationBuilder = new AutorizationContextBuilderDirector($database);
        $this->presentCheckListbuilder = new PresentCheckListContextBuilderDirector($database);
    }
    
    public function createDomainModel(): DomainModel
    {
        return new DomainModel();
    }
    
    public function createAutorizationContext(): AutorizationContext
    {
        return $this->autorizationBuilder->create();
    }
    
    public function createPresentCheckListContext(): PresentCheckListContext
    {
        return $this->presentCheckListbuilder->create();
    }
}

