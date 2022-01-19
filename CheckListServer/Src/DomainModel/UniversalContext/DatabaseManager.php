<?php
namespace Src\DomainModel\UniversalContext;

use Src\DomainModel\AutorizationContext\User;
use Exception;

class DatabaseManager implements DatabaseManagerInterface
{
    private bool $runInTestMode;
    private $connection;
    
    public function __construct(bool $runInTestMode)
    {
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
            if (!TestDatabaseDataGenerator::existTestData($this->connection)) {
                TestDatabaseDataGenerator::createTestData($this->connection);
            }
        }
    }
    
    public function __destruct()
    {
        pg_close($this->connection);
    }
        
    public function existUser(string $email): bool
    {
        try {
            DatabaseManager::executeQuery(
                $this->connection,
                DatabaseManager::generateSelectReqest(
                    'User', ['email' => $email]
                )
            );
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
    
    public static function executeQuery($connection, string $query)
    {
        return pg_query($connection, $query) or die('Error sql-request: ' . pg_last_error());
    }

    
    private static function generateSelectReqest(string $where, array $what): string
    {
        return sprintf("SELECT * FROM public.\"%s\"
            ORDER BY %s", $where, DatabaseManager::convertToListCreteria($what));
    }
    
    private static function convertToListCreteria(array $what): string
    {
        $result = '';
        foreach ($what as $name => $value)
        {
            $result = $result . sprintf('%s = %s,', $name, $value);
        }
        return substr($result, 0, -1);
    }
    
    public function addUser(User $user): bool
    {
        return DatabaseManager::executeQuery(
                $this->connection,
                DatabaseManager::generateInsertReqest(
                    'User', ['email' => $user->email, 'password' => $user->password]
                )
            );
            
    }
    
    private static function generateInsertReqest(string $where, array $what): string
    {
        return sprintf(
                "INSERT INTO public.\"%s\"(%s) 
                VALUES (%s)",
                $where, 
                DatabaseManager::extractKeys($what), 
                DatabaseManager::extractValues($what)
            );
    }
        
    private static function extractKeys(array $what): string
    {
        $result = '';
        foreach (array_keys($what) as $name)
        {
            $result = $result . sprintf('%s,', $name);
        }
        return substr($result, 0, -1);
    }
    
    private static function extractValues(array $what): string
    {
        $result = '';
        foreach (array_values($what) as $value)
        {
            $result = $result . sprintf('\'%s\',', $value);
        }
        return substr($result, 0, -1);
    }
}

