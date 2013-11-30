<?php

namespace CSV;

use PHP\Lang\ArrayObject;

class Row extends ArrayObject {

	public function __construct () {

		$argc = func_num_args();
		$argv = func_get_args();

		if($argc == 2) {
			if(is_array($argv[0]) && is_array($argv[1])) {
				$argv[0] = array_combine($argv[0], $argv[1]);
			} else if($argv[0] instanceof Row) {
				$argv[0] = $argv[0]->combineTo($argv[1]);
			} else if($argv[1] instanceof Row) {
				$argv[0] = $argv[1]->combine($argv[0]);
			}
			parent::__construct($argv[0]);
		} else {
			call_user_func_array(array($this, 'parent::__construct'), $argv);
		}
	}

}