<?php
namespace Src\DomainModel\PresentCheckListContext;

use Src\DomainModel\UniversalContext\DatabaseManagerInterface;
use Src\DomainModel\PresentCheckListContext\PresentCheckListAgregate;

class PresentCheckListContextBuilder
{
    private DatabaseManagerInterface $database;
    public function __construct(DatabaseManagerInterface $database)
    {
        $this->database = $database;
    }
    
    public function createPresentCheckListContext(): PresentCheckListContext
    {
        return new PresentCheckListContext();
    }
    
    public function buildPresentCheckListAgregate(): PresentCheckListAgregate
    {
        return new PresentCheckListAgregate($this->database);
    }
}

