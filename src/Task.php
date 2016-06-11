<?php

namespace Task;

class Task {
	public function __construct($tasks = null, $from = "", $to = "") {
		$this->tasks = $tasks;
		$this->from = $from;
		$this->to = $to;
	}

	public function getScope($parent) {
		if($parent === null) {
			return array( $this->from, $this->to );
		}
		return array($parent->from.$this->from, $parent->to.$this->to);
	}

	public function execute($parent) {
		if(!is_array($this->tasks)) {
			var_dump($this);
			exit();
		}
		foreach($this->tasks as $task) {
			$task->execute($this);
		}
	}


	public function announce($title, $rest) {
		echo join("\n", func_get_args() )."\n\n";
	}
}
