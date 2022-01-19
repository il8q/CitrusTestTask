<?php
namespace Src\DomainModel;

class DomainModelFacadeBuilderDirector
{
    private DomainModelFacadeBuilder $facadebuilder;
    private DomainModelBuilderDirector $domainBuilder;
    public function __construct()
    {
        $this->facadebuilder = new DomainModelFacadeBuilder();
        $this->domainBuilder = new DomainModelBuilderDirector();
    }
    
    public function create(): DomainModelFacade
    {
        $domainModel = $this->domainBuilder->create();
        $result = $this->facadebuilder->create($domainModel);
        return $result;
    }
}

