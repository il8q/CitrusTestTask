<?php
namespace Src\DomainModel\AutorizationContext;

class AutorizationContextBuilderDirector
{
    public function create(): AutorizationContext
    {
        return AutorizationContextBuilder::create();
    }
}

