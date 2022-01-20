<?php
namespace Src\DomainModel\UniversalContext;

use Src\DomainModel\AutorizationContext\User;
use Exception;

class DatabaseManager implements DatabaseManagerInterface
{
    private static $instances = [];
    
    private bool $runInTestMode;
    private $connection;
    
    protected function __construct(bool $runInTestMode) {
        $this->runInTestMode = $runInTestMode;
        
        /**
         * The PHP extension will look for libpq.dll which is found of
         * your PostgreSQL installation. The simple fix is to add the
         *  path than contains that file to your environment PATH.
         * @var \Src\DomainModel\UniversalContext\DatabaseManager $connection
         */
        
        $this->connection = pg_connect(
            "host=localhost
            port=5432
            dbname=checkListApplication
            user=postgres
            password=post"
            );
        //or die('Fail connection: ' . pg_last_error());
        
        if ($this->runInTestMode) {
            //echo $exception->getMessage();
            
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
        while ($line = pg_fetch_array($sqlData, null, PGSQL_ASSOC)) {
            $arr = [];
            foreach ($line as $value) {
                array_push($arr, $value);
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
                'User', ['email' => $email]
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
}

