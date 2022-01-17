<?php
namespace Src\DomainModel\AutorizationContext;

use Src\DomainModel\UniversalContext\Constants;

class RegestrationAgregate
{
    public EntityFactory $entityFactory;
    
    public function __construct()
    {}
    
    
    public function createUser(string $email, string $password): User
    {
        return entityFactory.createUser($email, $password);
    }
    
    public function addToUserList(User $user): bool
    {
        return Constants::FAIL;
    }
    
    
    public function transferUserTo(string $pageId): bool
    {
        return Constants::FAIL;
    }
}

