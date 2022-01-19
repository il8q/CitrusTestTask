<?php
namespace Src\DomainModel\AutorizationContext;

use Src\DomainModel\UniversalContext\DatabaseManagerInterface;

class RegestrationAgregate
{
    public EntityFactory $entityFactory;
    public DatabaseManagerInterface $database;
    
    public function __construct()
    {
    }
    
    
    public function createUser(string $email, string $password): User
    {
        return $this->entityFactory->createUser($email, $password);
    }
    
    public function addToUserList(User $user): bool
    {
        return $this->database->addUser($user);
    }
}

