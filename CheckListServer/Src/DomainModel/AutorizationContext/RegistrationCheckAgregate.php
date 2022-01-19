<?php
namespace Src\DomainModel\AutorizationContext;

use Src\DomainModel\UniversalContext\DatabaseManagerInterface;


class RegistrationCheckAgregate
{
    public DatabaseManagerInterface $database;
    
    public function __construct()
    {}
    
    public function existUser(string $email): bool
    {
        return $this->database->existUser($email);
    }
}

