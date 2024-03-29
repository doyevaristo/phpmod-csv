<?php

namespace CSV;

use PHP\Lang\ArrayObject;

class Reader extends AbstractBase
{
	private $headersInFirstRow = true;

	/**
	 *
	 * @var Fields
	 */
	private $headers;
	private $line;
	private $init;

	public function __construct($path, $mode = 'r+', $headersInFirstRow = true)
	{
		parent::__construct($path, $mode);
		$this->headersInFirstRow = $headersInFirstRow;
		$this->line = 0;
	}

	public function getHeaders()
	{
		$this->init();
		return $this->headers;
	}

	public function getRow()
	{
		$this->init();
		if (($row = fgetcsv($this->handle, 1000, $this->delimiter, $this->enclosure)) !== false) {
			$this->line++;
			return $this->headers ? new Row($this->headers, $row) : new Row($row);
		} else {
			return false;
		}
	}

	public function getAll()
	{
		$data = new ArrayObject();
		while ($row = $this->getRow()) {
			$data[] = $row;
		}
		return $data;
	}

	public function getLineNumber()
	{
		return $this->line;
	}

	protected function init()
	{
		if (true === $this->init) {
			return;
		}
		$this->init    = true;
		$this->headers = $this->headersInFirstRow === true ? $this->getRow() : false;
	}
}
