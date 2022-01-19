<?php
namespace Src\DomainModel;

use Src\DomainModel\AutorizationContext\AutorizationContext;
use Exception;

final class DomainModel
{
    public AutorizationContext $autorizationContext;
    public function __construct()
    {
        
    }
    
    public function register(string $email, string $password): string
    {
        $message = '';
        try {
            $this->autorizationContext->checkUserData($email);
            $this->autorizationContext->registerUser($email, $password);
            $message = 'transfer to start page';
        } catch (Exception $e) {
            $message = $e->getMessage();
        }
        return $message;
    }
    
}

