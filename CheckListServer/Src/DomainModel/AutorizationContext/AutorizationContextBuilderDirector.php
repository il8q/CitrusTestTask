<?php
namespace Src\DomainModel\AutorizationContext;

use Src\DomainModel\UniversalContext\DatabaseManagerInterface;

class AutorizationContextBuilderDirector
{
    private AutorizationContextBuilder $builder;
    public function __construct(DatabaseManagerInterface $database)
    {
        $this->builder = new AutorizationContextBuilder($database);
    }
    
    public function create(): AutorizationContext
    {
        $result = $this->builder->createContext();
        $result->autorization = $this->builder->buildAutorizationCheckAgregate();
        $result->regestrationCheck = $this->builder->buildRegestrationCheckAgregate();
        $result->regestration = $this->builder->buildRegestrationAgregate();
        return $result;
    }
}

