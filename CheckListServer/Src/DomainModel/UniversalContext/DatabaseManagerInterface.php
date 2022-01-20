<?php
namespace Src\DomainModel\UniversalContext;

use Src\DomainModel\AutorizationContext\User;

interface DatabaseManagerInterface
{
    public function existUser(string $email): bool;
    public function addUser(User $user): bool;
    public function getUser(string $email): array;  
    public function getCheckLists(): array;
    public function getPoints(int $checkListId): array;
}

