<?php

namespace Task;

class TaskRunTask extends Task {
	public function __construct($key) {
		$this->key = $key;
	}

	public function execute($from, $to) {
		runtask($this->key);
	}

}
