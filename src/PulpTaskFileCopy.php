<?php

namespace Pulp;

class PulpTaskFileCopy extends PulpTask {
	public $rename = null;
	public function execute($from, $to) {
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
