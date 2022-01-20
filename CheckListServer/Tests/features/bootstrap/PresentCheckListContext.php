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
     *
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
     *
     * @Then send "Check list"s in short form
     */
    public function sendCheckListSInShortForm()
    {
        $this->sendCheckList = $this->presentCheckListAgregate->getCheckListSInShortForm();
    }

    /**
     *
     * @Then in the form content :arg1, :arg2, :arg3
     */
    public function inTheFormContent()
    {
        assertSame('0', $this->sendCheckList[0][0]);
        assertSame('Hm... there must be title', $this->sendCheckList[0][1]);
        assertSame('And there definition', $this->sendCheckList[0][2]);
    }

    // Scenario: User unwrap check "Check list"
    /**
     *
     * @Given check list id=:id
     */
    public function givenCheckListId(int $id)
    {
        $this->checkListId = $id;
    }

    /**
     *
     * @Then send points from check list
     */
    public function sendPointSFrom()
    {
        $this->sendPoints = $this->presentCheckListAgregate->getPoints($this->checkListId);

        echo print_r($this->sendPoints);
        assertSame('0', $this->sendPoints[0][0]);
        assertSame('I must something do', $this->sendPoints[0][1]);
        assertSame('Just print text', $this->sendPoints[0][2]);

        assertSame('1', $this->sendPoints[1][0]);
        assertSame('Check link work', $this->sendPoints[1][1]);
        assertSame('Link example <a href="https://ru.stackoverflow.com">Stack Overflow</a>',
            $this->sendPoints[1][2]
        );
    }
}
