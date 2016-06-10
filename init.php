<?php

namespace Pulp;

function pulp($command, $handler) {
	$handler();
}

function scope($from, $to, $tasks) {
	foreach($tasks as $task) {
		$task->run($from, $to);
	}
}


function dircopy($from, $to) {
	return new PulpTaskDirCopy($from, $to);
}
function filecopy($from, $to, $rename = null) {
	$task = new PulpTaskFileCopy($from, $to);
	$task->rename = $rename;
	return $task;
}


/*
abstract class PulpTask {
	public function __construct($from, $to) {
		$this->from = $from;
		$this->to = $to;
	}

	public function run($baseFrom, $baseTo) {
		$from = $baseFrom.$this->from;
		$to = $baseTo.$this->to;
		$this->execute($from, $to);
	}


	public function announce($str, $from, $to) {
		echo $str . "\n$from\n$to\n\n";
	}

	abstract public function execute($from, $to);
}


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
 */
