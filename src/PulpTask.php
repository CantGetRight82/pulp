<?php

namespace Pulp;

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
