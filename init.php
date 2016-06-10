<?php

namespace Task;

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

function task($key, $handlers) {
	global $tasks;
	$tasks[$key] = $handlers;
}

function runtask($key) {
	global $tasks;
	if(isset($tasks[$key])) {
		echo "Running $key.\n";

		$arr = $tasks[$key];
		foreach($arr as $func) {
			$func();
		}
	} else {
		if($key == '') {
			echo "No default task available.";
		} else {
			echo "Task does not exist: $key.\n";
		}
	}
}

function run($key) {
	return new TaskRunTask($key);
}


function scope($from, $to, $tasks) {
	return new TaskScope($from, $to, $tasks);
}


function dircopy($from, $to) {
	return new TaskDirCopy($from, $to);
}
function filecopy($from, $to, $rename = null) {
	$task = new TaskFileCopy($from, $to);
	$task->rename = $rename;
	return $task;
}


