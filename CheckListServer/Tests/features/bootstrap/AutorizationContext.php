<?php
use function AutorizationContext\addToUserList;
use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use function PHPUnit\Framework\assertSame;
use Src\DomainModel\AutorizationContext\AutorizationContextBuilder;
use Src\DomainModel\AutorizationContext\RegestrationAgregate;
use Src\DomainModel\AutorizationContext\RegistrationCheckAgregate;
use Src\DomainModel\AutorizationContext\AutorizationCheckAgregate;
use Src\DomainModel\AutorizationContext\User;
use Src\DomainModel\UniversalContext\Constants;

class AutorizationContext implements Context
{

    private AutorizationCheckAgregate $autorization;

    private RegistrationCheckAgregate $regestrationCheck;

    private RegestrationAgregate $regestration;

    private AutorizationContextBuilder $builder;

    private string $email;

    private string $password;

    private User $user;

    public function __construct()
    {
        $this->builder = new AutorizationContextBuilder();
        $this->autorization = $this->builder->buildAutorizationCheckAgregate();
        $this->regestrationCheck = $this->builder->buildRegestrationCheckAgregate();
        $this->regestration = $this->builder->buildRegestrationAgregate();
    }

    // Scenario: Guest can register and become a user
    /**
     *
     * @Given e-mail :email and password :password
     */
    public function eMailAndPassword(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    /**
     *
     * @When e-mail not found in User list
     */
    public function emailNotFoundInUserList()
    {
        assertSame(false, $this->regestrationCheck->existUser($this->email));
    }

    /**
     *
     * @Then create User with e-mail and password
     */
    public function createUserWithEMailAndPassword()
    {
        $this->user = $this->regestration->createUser($this->email, $this->password);
        assertSame($this->email, $this->user->email);
        assertSame($this->password, $this->user->password);
    }

    /**
     *
     * @Then add to User list
     */
    public function addToUserList()
    {
        assertSame(
            Constants::SUCCESS,
            $this->regestration->addToUserList($this->user)
        );
    }

    /**
     *
     * @Then guest transfer to :page
     */
    public function guestTransferTo(string $page)
    {
        assertSame(
            Constants::SUCCESS,
            $this->regestration->transferUserTo($page)
        );
    }

    // Scenario: Guest can autorizate and transfer to "Main page"
    /**
     *
     * @When e-mail found
     */
    public function eMailFound()
    {
        throw new PendingException();
    }

    /**
     *
     * @When password equal password from User list
     */
    public function passwordEqualPasswordFromUserList()
    {
        throw new PendingException();
    }

    /**
     *
     * @Then guest stand User
     */
    public function guestStandUser()
    {
        throw new PendingException();
    }

    /**
     *
     * @Then User transfer to :arg1
     */
    public function userTransferTo($arg1)
    {
        throw new PendingException();
    }
}
