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

	if(isset($tasks[$key])) {
		echo "Running $key.\n";
	} else {
		if($key == '') {
			echo "No default task available.";
		} else {
			echo "Task does not exist: $key.\n";
		}
	}
});

function task($key, $handler) {
	global $tasks;
	$tasks[$key] = $handler;

	echo 'test1';
}

function scope($from, $to, $tasks) {
	foreach($tasks as $task) {
		$task->run($from, $to);
	}
}


function dircopy($from, $to) {
	return new TaskDirCopy($from, $to);
}
function filecopy($from, $to, $rename = null) {
	$task = new TaskFileCopy($from, $to);
	$task->rename = $rename;
	return $task;
}


