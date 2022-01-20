<?php
namespace Src\DomainModel\UniversalContext;

final class SqlReqestGenerator
{
    public static function generateSelectReqest(
        string $where,
        array $whatFind = array(),
        array $whatSelect = array()
    ): string
    {
        $selected = SqlReqestGenerator::generateWhatSelect($whatSelect);
        if (count($whatFind)) {
            return sprintf(
                "SELECT %s FROM public.\"%s\" WHERE %s", 
                $selected, $where, SqlReqestGenerator::convertToListCreteria($whatFind)
            );
        }

        return sprintf(
            "SELECT %s FROM public.\"%s\"",
            $selected, $where
        );
    }
    
    private static function generateWhatSelect(array $whatSelect): string
    {
        $result = "*";
        if (count($whatSelect)) {
            $result = SqlReqestGenerator::extractValues($whatSelect, false);
        }
        return $result;
    }
    
    private static function convertToListCreteria(array $what): string
    {
        $result = '';
        foreach ($what as $name => $value)
        {
            if (is_numeric($value)) {
                $result = $result . sprintf('%s = %s,', $name, $value);
            } else {
                $result = $result . sprintf('%s = \'%s\',', $name, $value);
            }
            
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
    
    private static function extractValues(array $what, bool $withQuotes = true): string
    {
        $result = '';
        foreach (array_values($what) as $value)
        {
            if ($withQuotes) {
                $result = $result . sprintf('\'%s\',', $value);
            } else {
                $result = $result . sprintf('%s,', $value);
            }
            
        }
        return substr($result, 0, -1);
    }
}

