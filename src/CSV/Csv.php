<?php

namespace CSV;

use PHP\Lang\ArrayObject;

class Csv extends ArrayObject {

	public function __construct($contents, $delimiter = ',', $enclosure = '"') {
		$lines = preg_split("/((\r?\n)|(\r\n?))/", $contents);
		$firstline = array_shift($lines);
		$fields = str_getcsv($firstline, $delimiter, $enclosure);
		foreach ($lines as $line){
			$line_array = str_getcsv($line, $delimiter, $enclosure);
				
			$combined = @array_combine($fields, $line_array);
				
			if($combined === FALSE) {
				$lastError = error_get_last();
				throw new \ErrorException($lastError['message'] .
						"\nkeys: " . $firstline .
						"values: " . $line,
						$lastError['type'], 1, $lastError['file'], $lastError['line']);
			}
				
			$this->append($combined);
		}
	}

}