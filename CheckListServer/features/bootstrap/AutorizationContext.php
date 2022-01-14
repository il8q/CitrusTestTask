<?php
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use PHPUnit\Framework\Assert as Assert;

class AutorizationContext implements Context
{
    public function __construct()
    {
    }
    

    /**
     * @Given e-mail :arg1 and password :arg2
     */
    public function eMailAndPassword($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @When e-mail and password not found in User list
     */
    public function eMailAndPasswordNotFoundInUserList()
    {
        throw new PendingException();
    }

    /**
     * @Then create User with e-mail and password
     */
    public function createUserWithEMailAndPassword()
    {
        throw new PendingException();
    }

    /**
     * @Then add to User list
     */
    public function addToUserList()
    {
        throw new PendingException();
    }

    /**
     * @Then guest transfer to :arg1
     */
    public function guestTransferTo($arg1)
    {
        throw new PendingException();
    }

    /**
     * @When e-mail found
     */
    public function eMailFound()
    {
        throw new PendingException();
    }

    /**
     * @When password equal password from User list
     */
    public function passwordEqualPasswordFromUserList()
    {
        throw new PendingException();
    }

    /**
     * @Then guest stand User
     */
    public function guestStandUser()
    {
        throw new PendingException();
    }

    /**
     * @Then User transfer to :arg1
     */
    public function userTransferTo($arg1)
    {
        throw new PendingException();
    }


    
}
