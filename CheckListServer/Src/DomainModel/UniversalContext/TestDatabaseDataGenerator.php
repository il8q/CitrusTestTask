<?php
namespace Src\DomainModel\UniversalContext;

use Exception;

final class TestDatabaseDataGenerator
{
    public static function existTestData($connection): bool{
        try {
            $result = DatabaseManager::executeQuery(
                $connection,
                'SELECT * FROM public."CheckList"
                 ORDER BY id ASC'
            );
            return gettype($result) != 'boolean';
        } catch (Exception $exception) {
            return false;
        }
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
            'CREATE TABLE IF NOT EXISTS public."User"
            (
                id bigint NOT NULL GENERATED BY DEFAULT AS IDENTITY ( INCREMENT 1 START 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1 ),
                email character varying(100) COLLATE pg_catalog."default",
                password character varying(20) COLLATE pg_catalog."default",
                CONSTRAINT user_email UNIQUE (email)
            )'
        );
        DatabaseManager::executeQuery(
            $connection,
            'CREATE TABLE IF NOT EXISTS public."Point"
            (
                id bigint NOT NULL GENERATED BY DEFAULT AS IDENTITY ( INCREMENT 1 START 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1 ),
                title text COLLATE pg_catalog."default",
                point_text text COLLATE pg_catalog."default"
            )'
        );
        
        DatabaseManager::executeQuery(
            $connection,
            'CREATE TABLE IF NOT EXISTS public."CheckList"
            (
                id bigint NOT NULL GENERATED BY DEFAULT AS IDENTITY ( INCREMENT 1 START 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1 ),
                title text COLLATE pg_catalog."default",
                definition text COLLATE pg_catalog."default",
                points bigint[]
            )'
        );
        
    }
    private static function insertTestData($connection)
    {
        DatabaseManager::executeQuery(
            $connection,
            'INSERT INTO public."CheckList"(
        	id, title, definition, points)
        	VALUES (0,
                \'Hm... there must be title\', 
                \'And there definition\',
                \'{0, 1}\'
            );'
        );
        DatabaseManager::executeQuery(
            $connection,
            'INSERT INTO public."Point"(
        	id, title, point_text)
        	VALUES (0, \'I must something do\', \'Just print text\');'
        );
        
        DatabaseManager::executeQuery(
            $connection,
            'INSERT INTO public."Point"(
        	id, title, point_text)
        	VALUES (
                1,
                \'Check link work\',
                \'Link example <a href="https://ru.stackoverflow.com">Stack Overflow</a>\'
            );'
        );
        DatabaseManager::executeQuery(
            $connection,
            'INSERT INTO public."CheckList"(
        	id, definition, title, points)
        	VALUES (
                1,
                \'What else can be in the project\',
                \'If the project is production but not test task, then need add:\', 
                \'{2, 3, 4}\'
            );'
        );
        DatabaseManager::executeQuery(
            $connection,
            'INSERT INTO public."Point"(
        	id, title, point_text)
        	VALUES (2, \'Logger\', \'But I log only result http-request\');'
        );
        DatabaseManager::executeQuery(
            $connection,
            'INSERT INTO public."Point"(
        	id, title, point_text)
        	VALUES (
                3,
                \'BDD and TDD tests\',
                \'There test only basic, need system tests and module tests\'
            );'
        );
        DatabaseManager::executeQuery(
            $connection,
            'INSERT INTO public."Point"(
        	id, title, point_text)
        	VALUES (
                4,
                \'Use frontend framework\',
                \'Most likely Vue, since you use it\'
            );'
        );
    }
}

