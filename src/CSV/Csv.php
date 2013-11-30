<?php

namespace CSV;

use PHP\Lang\ArrayObject;

class Csv extends ArrayObject {

	public function __construct($contents, $delimiter = ',', $enclosure = '"') {
		$lines = preg_split("/((\r?\n)|(\r\n?))/", $contents);
		$firstline = array_shift($lines);
		$fields = str_getcsv($firstline, $delimiter, $enclosure);
		foreach ($lines as $line){
			$line = str_getcsv($line, $delimiter, $enclosure);
			$this->append(array_combine($fields, $line));
		}
	}

}