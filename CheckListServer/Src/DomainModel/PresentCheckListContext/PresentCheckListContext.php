<?php
namespace Src\DomainModel\PresentCheckListContext;

class PresentCheckListContext
{
    public PresentCheckListAgregate $presentAgregate;
    public function __construct()
    {}
    
    public function getCheckListSInShortForm(): array
    {
        return $this->presentAgregate->getCheckListSInShortForm();
    }
    
    
    public function getPoints(int $checkListId): array
    {
        return $this->presentAgregate->getPoints($checkListId);
    }
}

