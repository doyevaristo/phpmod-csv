<?php

namespace CSV;

class CsvTest extends \PHPUnit_Framework_TestCase
{

	public function testConstructor() {
		$contents = file_get_contents(__DIR__ . '/../data/read_sc.csv');

		$csv = new Csv($contents, ";");

		$expected = array(
				array("column1" => "1column2value", "column2" => "1column3value", "column3" => "1column4value"),
				array("column1" => "2column2value", "column2" => "2column3value", "column3" => "2column4value"),
				array("column1" => "3column2value", "column2" => "3column3value", "column3" => "3column4value"),
				array("column1" => "4column2value", "column2" => "4column3value", "column3" => "4column4value"),
				array("column1" => "5column2value", "column2" => "5column3value", "column3" => "5column4value"),
		);

		$this->assertEquals($expected, $csv->toPrimitiveArray());

		try {
			$csv = new Csv("name,age\nhassan");
			$this->fail("should catch error");
		} catch (\ErrorException $e) {
				
		}

	}

}