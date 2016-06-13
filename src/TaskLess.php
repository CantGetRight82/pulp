<?php

namespace Task;

class TaskLess extends Task {
	public function __construct($from, $to) {
		parent::__construct(null, $from,  $to);
	}
	public function execute($parent) {
		list($from, $to) = $this->getScope($parent);
		$this->announce('less', $from, $to);

		passthru('lessc '.escapeshellarg($from).' '.escapeshellarg($to));
		/*

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
		 */
	}
}
