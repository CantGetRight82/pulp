<?php

namespace Task;

class TaskRunTask extends Task {
	public function __construct($key) {
		$this->key = $key;
	}

	public function execute($parent) {
		runtask($this->key);
	}

}
