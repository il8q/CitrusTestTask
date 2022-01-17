<?php
namespace Src\DomainModel\AutorizationContext;

class AutorizationContextBuilder
{

    public function __construct()
    {
        
    }
    
    public function create(): AutorizationContext
    {
        return NULL;
    }
    
    public function buildAutorizationCheckAgregate(): AutorizationCheckAgregate
    {
        return new AutorizationCheckAgregate();
    }
    
    public function buildRegestrationCheckAgregate(): RegistrationCheckAgregate
    {
        return new RegistrationCheckAgregate();
    }
    
    public function buildRegestrationAgregate(): RegestrationAgregate
    {
        $result =  new RegestrationAgregate();
        $result->entityFactory = new EntityFactory();
        return $result;
    }
}

