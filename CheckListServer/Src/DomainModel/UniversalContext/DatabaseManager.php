<?php
namespace Src\DomainModel\UniversalContext;

use Src\DomainModel\AutorizationContext\User;
use Exception;
use Behat\Testwork\Specification\SpecificationArrayIterator;

class DatabaseManager implements DatabaseManagerInterface
{
    private static $instances = [];
    
    private bool $runInTestMode;
    private $connection;
    
    protected function __construct(bool $runInTestMode) {
        $this->runInTestMode = $runInTestMode;

        $this->connection = pg_connect(
            "host=localhost
            port=5432
            dbname=checkListApplication
            user=postgres
            password=post"
            );
        //or die('Fail connection: ' . pg_last_error());
        
        if ($this->runInTestMode) {
            if (!TestDatabaseDataGenerator::existTestData($this->connection)) {
                TestDatabaseDataGenerator::createTestData($this->connection);
            }
            
        }
    }
    
    public static function getInstance(bool $runInTestMode): DatabaseManager
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static($runInTestMode);
        }
        
        return self::$instances[$cls];
    }
    
    public function __destruct()
    {
        pg_close($this->connection);
    }
        
    public function existUser(string $email): bool
    {
        try {
            $sqlData = DatabaseManager::findUser($email);
            $result = DatabaseManager::extractArrays($sqlData);
            return count($result) > 0;
        } catch (Exception $e) {
            return false;
        }
        
    }
    
    private static function extractArrays($sqlData): array
    {
        $result = [];
        
        $object = pg_fetch_all($sqlData);
        foreach($object as $key=>$value){
            $arr = [];
            foreach ($value as $value2) {
                
                array_push($arr, $value2);
            }
            array_push($result, $arr);
        }

        
        return $result;
    }
    
    private function findUser(string $email)
    {
        return DatabaseManager::executeQuery(
            $this->connection,
            SqlReqestGenerator::generateSelectReqest(
                'User', ['email' => $email], array()
            )
        );
    }
    
    public static function executeQuery($connection, string $query)
    {
        try {
            $result = pg_query($connection, $query);
            if (gettype($result) == 'boolean')
            {
                throw new Exception(pg_last_error());
            }
            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }
    
    public function addUser(User $user): bool
    {
         DatabaseManager::executeQuery(
            $this->connection,
             SqlReqestGenerator::generateInsertReqest(
                'User', ['email' => $user->email, 'password' => $user->password]
            )
         );
         return true; 
    }
    
    public function getUser(string $email): array
    {
        $sqlData = DatabaseManager::findUser($email);
        return DatabaseManager::extractArrays($sqlData)[0];
    }
    
    public function getCheckLists(): array
    {
        $sqlData = DatabaseManager::executeQuery(
            $this->connection,
            SqlReqestGenerator::generateSelectReqest(
                'CheckList', 
                array(), 
                DatabaseManager::generateWhatSelect(false)
            )
        );

        return DatabaseManager::extractArrays($sqlData);
    }
    
    private static function generateWhatSelect(bool $getWithPoints): array
    {
        $result = array();
        if (!$getWithPoints) {
            $result = [ 'id', 'title', 'definition' ];
        }
        return $result;
    }
    
    public function getPoints(int $checkListId): array
    {
        $checkList = DatabaseManager::findCheckList($this->connection, $checkListId);
        $result = $this->foundPoints(preg_split("/[\s,]+/", substr($checkList[0][3], 1, -1)));
        return $result;
    }
    
    private static function findCheckList($connection, int $checkListId): array
    {
        $sqlData = DatabaseManager::executeQuery(
            $connection,
            SqlReqestGenerator::generateSelectReqest(
                'CheckList',
                ['id' => $checkListId],
                DatabaseManager::generateWhatSelect(true)
            )
        );
        return DatabaseManager::extractArrays($sqlData);
    }
    
    private function foundPoints(array $pointIds): array
    {
        $result = [];
        for ($i = 0; $i < count($pointIds); $i++) {
            $sqlData = DatabaseManager::executeQuery(
                $this->connection,
                SqlReqestGenerator::generateSelectReqest(
                    'Point',
                    ['id' => $pointIds[$i]]
                )
            );
            array_push($result, DatabaseManager::extractArrays($sqlData));
            $result[$i] = $result[$i][0];
        }
        return $result;
    }
}

