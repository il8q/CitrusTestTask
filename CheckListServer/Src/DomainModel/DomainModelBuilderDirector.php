<?php
namespace Src\DomainModel;

use Src\DomainModel\UniversalContext\DatabaseManager;

final class DomainModelBuilderDirector
{
    private DomainModelBuilder $builder;
    public function __construct()
    {
        $database = new DatabaseManager(false);
        $this->builder = new DomainModelBuilder($database);
    }
    
    public function create(): DomainModel {
        $result = $this->builder->createDomainModel();
        $result->autorizationContext = $this->builder->createAutorizationContext();
        return $result;
    }
}

