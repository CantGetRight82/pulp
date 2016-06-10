<?php

namespace Pulp;

class PulpTaskDirCopy extends PulpTask {
	public function execute($from, $to) {
		$this->announce('dircopy', $from, $to);

		$found = shell_exec( 'find '.escapeshellarg($from) );
		$files = explode("\n", trim($found) );

		$cut = strlen($from);
		foreach($files as $file) {
			$local = substr($file, $cut);
			$target = $to . $local;
			if(is_dir($file)) {
				if(!is_dir($target)) {
					mkdir($target, 0777, true);
				}
			} else {
				copy($file, $target);
			}
		}
	}

}
