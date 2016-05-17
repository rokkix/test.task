<?php

namespace App\Core;

class Logging
{
    const DEFAULT_FILENAME = __DIR__ . '/../Views/logexception.txt';
    
    public static function toFile(\Exception $e, $filename = '')
    {
        $filename = !empty($filename) ? $filename : self::DEFAULT_FILENAME;
        $data = date('d-m-Y H:m:s') . '  ' . $e->getFile() . '  в строке: ' .
        $e->getLine() . ' код ошибки:  ' . $e->getCode() . '  ' . $e->getMessage();
        file_put_contents($filename, $data . PHP_EOL, FILE_APPEND);
    }
}