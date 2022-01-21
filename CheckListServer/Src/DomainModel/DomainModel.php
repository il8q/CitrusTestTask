<?php
namespace Src\DomainModel;

use Src\DomainModel\AutorizationContext\AutorizationContext;
use Src\DomainModel\PresentCheckListContext\PresentCheckListContext;
use Exception;

final class DomainModel
{
    public AutorizationContext $autorizationContext;
    public PresentCheckListContext $presentCheckListContext;
    public function __construct()
    {
        
    }
    
    public function register(string $email, string $password): array
    {
        try {
            $this->autorizationContext->checkUserData($email);
            $this->autorizationContext->registerUser($email, $password);
            return ['command' => 'transfer to start page'];
        } catch (Exception $e) {
            return ['error_message' => $e->getMessage()];
        }
    }
    
    public function getCheckListsInShortForm(): array
    {
        try {
            return $this->presentCheckListContext->getCheckListSInShortForm();
        } catch (Exception $e) {
            return ['error_message' => $e->getMessage()];
        }
    }
    
    
    public function getPoints(int $checkListId): array
    {
        try {
            return $this->presentCheckListContext->getPoints($checkListId);
        } catch (Exception $e) {
            return ['error_message' => $e->getMessage()];
        }
    }
    
}

