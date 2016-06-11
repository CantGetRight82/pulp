<?php

namespace Task;

class TaskFileCopy extends Task {
	private $rename = null;
	public function __construct($from, $to, $rename = null) {
		parent::__construct(null, $from,  $to);
		$this->rename = $rename;
	}
	public function execute($parent) {
		list($from, $to) = $this->getScope($parent);
		$filename = $this->rename;
		if($filename === null) {
			$filename = basename($from);
		}
		$target = $to . '/' . $filename;
		$this->announce('filecopy', $from, $target);
		if(!is_dir($to)) {
			mkdir($to, 0777, true);
		}
		copy($from, $target);
	}

}
