<?php

namespace App\Helpers;

class CsvToArray
{
    public function csv_to_array($filename, $header)
    {
        $delimiter = ',';
        if (!file_exists($filename) || !is_readable($filename)) {
            return false;
        }

        $data = [];
        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
                if (count($row) === count($header)) {
                    $data[] = array_combine($header, $row);
                } else {
                    continue;
                }
            }
            fclose($handle);
        }

        return $data;
    }
}
