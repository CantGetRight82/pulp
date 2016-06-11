<?php

namespace Task;


function task($key, $handlers) {
	global $tasks;
	$task = new Task($handlers);
	$tasks[$key] = $task;
	return $task;
}

function scope($from, $to, $tasks) {
	return new Task($tasks, $from, $to);
}

function run($key) {
	return new TaskRunTask($key);
}

function dircopy($from, $to) {
	return new TaskDirCopy($from, $to);
}

function filecopy($from, $to, $rename = null) {
	$task = new TaskFileCopy($from, $to, $rename);
	return $task;
}


$tasks = array();
register_shutdown_function( function() {
	global $tasks;

	$key = '';
	$args = $GLOBALS['argv'];
	if(count($args)>1) {
		$key = $args[1];
	}

	runtask($key);
});

function runtask($key) {
	global $tasks;
	if(isset($tasks[$key])) {
		echo "Running $key.\n";
		$tasks[$key]->execute(null);
	} else {
		if($key == '') {
			echo "No default task available.";
		} else {
			echo "Task does not exist: $key.\n";
		}
	}
}
