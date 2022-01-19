<?php
namespace Src\DomainModel;

class DomainModelFacadeBuilder
{

    public function __construct()
    {}
    
    public function create(DomainModel $domainModel): DomainModelFacade
    {
        return new DomainModelFacade($domainModel);
    }
}

