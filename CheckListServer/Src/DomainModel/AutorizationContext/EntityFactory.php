<?php
namespace Src\DomainModel\AutorizationContext;

class EntityFactory
{

    public function __construct()
    {}
    
    public function createUser(string $email, string $password)
    {
        return new User($email, $password);
    }
}

