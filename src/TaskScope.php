<?php


class TaskScope {
	public function __construct($from, $to, $tasks) {
		$this->from = $from;
		$this->to = $to;
		$this->tasks = $tasks;
	}

	public function execute() {
		foreach($this->tasks as $task) {
			$task->run($this->from, $this->to);
		}
	}
}

