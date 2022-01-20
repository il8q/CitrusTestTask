<?php
namespace Src\DomainModel\PresentCheckListContext;

use Src\DomainModel\UniversalContext\DatabaseManagerInterface;

class PresentCheckListAgregate
{
    private DatabaseManagerInterface $database;
    public function __construct(DatabaseManagerInterface $database)
    {
        $this->database = $database;
    }
    
    public function getCheckListSInShortForm(): array
    {
        return [];
    }
}

