<?php
namespace Src\DomainModel\PresentCheckListContext;

use Src\DomainModel\UniversalContext\DatabaseManagerInterface;

class PresentCheckListContextBuilderDirector
{
    private PresentCheckListContextBuilder $builder;
    public function __construct(DatabaseManagerInterface $database)
    {
        $this->builder = new PresentCheckListContextBuilder($database);
    }
    
    public function create(): PresentCheckListContext
    {
        $result = $this->builder->createContext();
        $result->presentAgregate = $this->builder->buildPresentCheckListAgregate();
        return $result;
    }
}

