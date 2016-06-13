<?php

namespace Task;


$tasks = null;
function task($key, $handlers) {
	global $tasks;
	if($tasks === null) {
		register_shutdown_function( function() use ($tasks) {
			$key = '';
			$args = $GLOBALS['argv'];
			if(count($args)>1) {
				$key = $args[1];
			}

			runtask($key);
		});

	}
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

function less($from, $to) {
	return new TaskLess($from, $to);
}


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
