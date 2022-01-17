<?php
namespace Src\DomainModel\AutorizationContext;

class RegistrationContextBuilder
{

    public function __construct()
    {
        
    }
    
    public function createRegistrationCheckAgregate(): RegistrationCheckAgregate
    {
        return new RegistrationCheckAgregate();
    }
}
