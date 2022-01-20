<?php
namespace Src\DomainModel\UniversalContext;

final class SqlReqestGenerator
{
    public static function generateSelectReqest(string $where, array $what): string
    {
        return sprintf("SELECT * FROM public.\"%s\"
            WHERE %s", $where, DatabaseManager::convertToListCreteria($what));
    }
    
    private static function convertToListCreteria(array $what): string
    {
        $result = '';
        foreach ($what as $name => $value)
        {
            $result = $result . sprintf('%s = \'%s\',', $name, $value);
        }
        return substr($result, 0, -1);
    }
    
    public static function generateInsertReqest(string $where, array $what): string
    {
        return sprintf(
            "INSERT INTO public.\"%s\"(%s)
                VALUES (%s)",
            $where,
            SqlReqestGenerator::extractKeys($what),
            SqlReqestGenerator::extractValues($what)
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

