<?php

class FileUtility
{
    // Method to write data to a file
    public static function writeToFile($filename, $data)
    {
        $file = fopen($filename, 'w');
        if ($file === false) {
            throw new Exception("Unable to open file for writing: $filename");
        }
        foreach ($data as $line) {
            fputcsv($file, $line);
        }
        fclose($file);
    }

    // Method to read data from a file
    public static function readFromFile($filename)
    {
        $file = fopen($filename, 'r');
        if ($file === false) {
            throw new Exception("Unable to open file for reading: $filename");
        }
        $data = [];
        while (($line = fgetcsv($file)) !== false) {
            $data[] = $line;
        }
        fclose($file);
        return $data;
    }
}
