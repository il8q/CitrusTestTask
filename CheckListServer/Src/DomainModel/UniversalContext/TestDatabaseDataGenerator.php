<?php
namespace Src\DomainModel\UniversalContext;

use Exception;

final class TestDatabaseDataGenerator
{
    public static function existTestData($connection): bool{
        try {
            DatabaseManager::executeQuery(
                $connection,
                "SELECT * FROM public.\"CheckList\"
                 ORDER BY id ASC"
            );
        } catch (Exception $exception) {
            return false;
        }
        return true;
    }
    
    public static function createTestData($connection): bool{
        TestDatabaseDataGenerator::createTables($connection);
        TestDatabaseDataGenerator::insertTestData($connection);
        return Constants::SUCCESS;
    }
    
    private static function createTables($connection)
    {
        DatabaseManager::executeQuery(
            $connection,
            "CREATE TABLE IF NOT EXISTS public.\"User\"
            (
                id bigint NOT NULL DEFAULT nextval('\"User_id_seq\"'::regclass),
                email character varying(100) COLLATE pg_catalog.\"default\",
                password character varying(20) COLLATE pg_catalog.\"default\",
                CONSTRAINT \"User_pkey\" PRIMARY KEY (id)
                CONSTRAINT user_email UNIQUE (email)
            )"
        );
        DatabaseManager::executeQuery(
            $connection,
            "CREATE TABLE IF NOT EXISTS public.\"Point\"
            (
                id bigint NOT NULL DEFAULT nextval('\"Point_id_seq\"'::regclass),
                title text COLLATE pg_catalog.\"default\",
                \"pointText\" text COLLATE pg_catalog.\"default\",
                CONSTRAINT \"Point_pkey\" PRIMARY KEY (id)
            )"
        );
        
        DatabaseManager::executeQuery(
            $connection,
            "CREATE TABLE IF NOT EXISTS public.\"CheckList\"
            (
                id bigint NOT NULL DEFAULT nextval('\"CheckList_id_seq\"'::regclass),
                definition text COLLATE pg_catalog.\"default\",
                title text COLLATE pg_catalog.\"default\",
                points bigint[],
                CONSTRAINT \"CheckList_pkey\" PRIMARY KEY (id)
            )"
        );
        
    }
    private static function insertTestData($connection)
    {
        DatabaseManager::executeQuery(
            $connection,
            "INSERT INTO public.\"User\"(
        	id, email, password)
        	VALUES (0, 'guestTest@gmail.com', 'passwordTest1');"
        );
        DatabaseManager::executeQuery(
            $connection,
            "INSERT INTO public.\"CheckList\"(
        	id, definition, title, points)
        	VALUES (0,
                'And there definition',
                'Hm... there must be title', '{0, 1}'
            );"
        );
        DatabaseManager::executeQuery(
            $connection,
            "INSERT INTO public.\"Point\"(
        	id, title, \"pointText\")
        	VALUES (0, 'I must something do', 'Just print text');"
        );
        
        DatabaseManager::executeQuery(
            $connection,
            "INSERT INTO public.\"Point\"(
        	id, title, \"pointText\")
        	VALUES (
                1,
                'Check link work',
                'Link example <a href=\"https://ru.stackoverflow.com\">Stack Overflow</a>'
            );"
        );
        DatabaseManager::executeQuery(
            $connection,
            "INSERT INTO public.\"CheckList\"(
        	id, definition, title, points)
        	VALUES (
                1,
                'If the project is production but not test task, then need add:', 'What else can be in the project',
                '{2, 3, 4}'
            );"
        );
        DatabaseManager::executeQuery(
            $connection,
            "INSERT INTO public.\"Point\"(
        	id, title, \"pointText\")
        	VALUES (2, 'Logger', 'But I log only result http-request;"
        );
        DatabaseManager::executeQuery(
            $connection,
            "INSERT INTO public.\"Point\"(
        	id, title, \"pointText\")
        	VALUES (
                3,
                'BDD and TDD tests',
                'There test only basic, need system tests and module tests'
            );"
        );
        DatabaseManager::executeQuery(
            $connection,
            "INSERT INTO public.\"Point\"(
        	id, title, \"pointText\")
        	VALUES (
                4,
                'Use frontend framework',
                'Most likely Vue, since you use it'
            );"
        );
    }
}

