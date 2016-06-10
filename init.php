<?php

namespace Task;

$tasks = array();

	var_dump($GLOBALS['argv']);
register_shutdown_function( function() {
});

function task($command, $handler) {
	global $tasks;
	$tasks[$command] = $handler;


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


