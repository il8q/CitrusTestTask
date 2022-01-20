<?php
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Src\DomainModel\PresentCheckListContext\PresentCheckListAgregate;
use Src\DomainModel\PresentCheckListContext\PresentCheckListContextBuilder;
use Src\DomainModel\UniversalContext\DatabaseManagerInterface;
use Src\DomainModel\UniversalContext\DatabaseManager;
use PHPUnit\Framework\Assert as Assert;
use function PHPUnit\Framework\assertSame;

class PresentCheckListContext implements Context
{
    private PresentCheckListContextBuilder $builder;
    private DatabaseManagerInterface $database;
    private PresentCheckListAgregate $presentCheckListAgregate;
    private array $sendCheckList;
    
    public function __construct()
    {
        $this->database = DatabaseManager::getInstance(true);
        $this->builder = new PresentCheckListContextBuilder($this->database);
        
        $this->presentCheckListAgregate = $this->builder->buildPresentCheckListAgregate();
    }
    
    // Scenario: User open "Main page" and see "Check list"s
    /**
     * @When :arg1 is opening
     */
    public function isOpeningPage(string $arg1)
    {
        /**
         * "Main page" open on frontend and for creating page
         * frontend-server send get-reqest
         */
    }
    
    /**
     * @Then send "Check list"s in short form
     */
    public function sendCheckListSInShortForm()
    {
        $this->sendCheckList = $this->presentCheckListAgregate->getCheckListSInShortForm();
        assertSame('array', $this->sendCheckList);
    }
    
    /**
     * @Then in the form content :arg1, :arg2, :arg3
     */
    public function inTheFormContent($arg1, $arg2, $arg3)
    {
        assertSame('number', gettype($this->sendCheckList[0][0]));
        assertSame(true, $this->sendCheckList[0][0] != 0);
        assertSame('Hm... there must be title', $this->sendCheckList[0][1]);
        assertSame('And there definition', $this->sendCheckList[0][2]);
    }
    
    // Scenario: User unwrap check "Check list"
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
