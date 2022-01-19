<?php
namespace Src\DomainModel\UniversalContext;

use Src\DomainModel\AutorizationContext\User;

interface DatabaseManagerInterface
{
    public function existUser(string $email): bool;
    public function addUser(User $user): bool;
}

