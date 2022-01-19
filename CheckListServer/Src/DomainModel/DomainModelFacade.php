<?php
namespace Src\DomainModel;

use function PHPUnit\Framework\throwException;

final class DomainModelFacade
{
    private DomainModel $domain;
    public function __construct(DomainModel $domainModel)
    {
        $this->domain = $domainModel;
    }
    
    public function register(string $email, string $password): string
    {
        return $this->domain->register($email, $password);
    }
}

