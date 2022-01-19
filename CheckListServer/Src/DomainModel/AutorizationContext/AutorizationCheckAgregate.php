<?php
namespace Src\DomainModel\AutorizationContext;

use Src\DomainModel\UniversalContext\DatabaseManagerInterface;

class AutorizationCheckAgregate
{
    public DatabaseManagerInterface $database;
    public function __construct()
    {}
    
    public function passwordEqual(string $email, string $password): bool
    {
        $user = $this->database->getUser($email);
        return $user[2] == $password;
    }
}

