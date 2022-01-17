<?php
namespace Src\DomainModel\AutorizationContext;

use Src\DomainModel\UniversalContext\Constants;
use Behat\Behat\Tester\Exception\PendingException;



class RegistrationCheckAgregate
{

    public function __construct()
    {}
    
    public function existUser(string $email): bool
    {
        throw new PendingException();
    }
}

