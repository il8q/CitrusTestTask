<?php
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use PHPUnit\Framework\Assert as Assert;

class PresentCheckListContext implements Context
{
    public function __construct()
    {
    }
    
    
    /**
     * @When :arg1 is opening
     */
    public function isOpeningPage($arg1)
    {
        throw new PendingException();
    }
    
    /**
     * @Then send "Check list"s in short form
     */
    public function sendCheckListSInShortForm()
    {
        throw new PendingException();
    }
    
    /**
     * @Then in the form content :arg1, :arg2, :arg3
     */
    public function inTheFormContent($arg1, $arg2, $arg3)
    {
        throw new PendingException();
    }
    
    /**
     * @Given :arg1 from :arg2
     */
    public function from($arg1, $arg2)
    {
        throw new PendingException();
    }
    
    /**
     * @Then send "point"s from :arg1
     */
    public function sendPointSFrom($arg1)
    {
        throw new PendingException();
    }
    
    
}
