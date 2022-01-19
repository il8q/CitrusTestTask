<?php
namespace Src\DomainModel\AutorizationContext;

use Src\DomainModel\UniversalContext\DatabaseManagerInterface;

class AutorizationContextBuilder
{
    private DatabaseManagerInterface $database;
    
    public function __construct(DatabaseManagerInterface $database)
    {
        $this->database = $database;
    }
    
    public function createContext(): AutorizationContext
    {
        return new AutorizationContext();
    }

    public function buildAutorizationCheckAgregate(): AutorizationCheckAgregate
    {
        $result =  new AutorizationCheckAgregate();
        $result->database = $this->database;
        return $result;
    }
    
    public function buildRegestrationCheckAgregate(): RegistrationCheckAgregate
    {
        $result =  new RegistrationCheckAgregate();
        $result->database = $this->database;
        return $result;
    }
    
    public function buildRegestrationAgregate(): RegestrationAgregate
    {
        $result =  new RegestrationAgregate();
        $result->entityFactory = new EntityFactory();
        $result->database = $this->database;
        return $result;
    }
}

