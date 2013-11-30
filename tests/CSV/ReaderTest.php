<?php

namespace CSV;

class ReaderTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider getReaders
	 */
	public function testOneAtAtime(Reader $reader)
	{
		while($row = $reader->getRow()) {
			$this->assertTrue($row instanceof Row);
			$this->assertEquals(3, count($row));
		}
	}

	/**
	 * @dataProvider getReaders
	 */
	public function testGetAll(Reader $reader)
	{
		$this->assertEquals(5, count($reader->getAll()));
	}

	/**
	 * @dataProvider getReaders
	 */
	public function testGetHeaders(Reader $reader)
	{
		$this->assertEquals(array("column1", "column2", "column3"), $reader->getHeaders()->toPrimitiveArray());
	}

	public function getReaders()
	{
		$readerSemiColon = new Reader(__DIR__ . '/../data/read_sc.csv');
		$readerSemiColon->setDelimiter(';');
		return array(
				array(new Reader(__DIR__ . '/../data/read.csv')),
				array($readerSemiColon),
		);
	}
}
