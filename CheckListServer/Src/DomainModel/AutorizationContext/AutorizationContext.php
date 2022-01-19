<?php
namespace Src\DomainModel\AutorizationContext;

use Exception;

class AutorizationContext
{
    public EntityFactory $entiryFactory;
    
    public AutorizationCheckAgregate $autorization;
    public RegistrationCheckAgregate $regestrationCheck;
    public RegestrationAgregate $regestration;
    
    public function __construct()
    {
    }
    
    public function checkUserData(string $email)
    {
        if ($this->regestrationCheck->existUser($email)) {
            throw new Exception(sprintf('User with e-mail %s exist', $email));
        };
    }
    
    public function registerUser(string $email, string $password)
    {
        $user = $this->regestration->createUser($email, $password);
        $this->regestration->addToUserList($user);
    }
}
