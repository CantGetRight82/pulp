<?php

namespace Task;

spl_autoload_register( function($className) {
	$parts = explode('\\', $className);
	require_once( __DIR__.'/../src/'.end($parts).'.php');
});
require_once( __DIR__ .'/../init.php');


$prea = 'test/a/';
$preb = 'test/b/';

task('copyfiles', [

	scope($prea.'vendor/bower_dl/',$preb.'resources/assets/', [
		dircopy('bootstrap/less', 'less/bootstrap'),
		filecopy('jquery/dist/jquery.js', 'js'),
		filecopy('bootstrap/dist/js/bootstrap.js', 'js'),
		filecopy('datatables/media/js/jquery.dataTables.js', 'js'),
	]),
	
	scope($prea.'vendor/bower_dl/datatables-plugins/integration/', $preb.'resources/assets/', [
		filecopy('bootstrap/3/dataTables.bootstrap.css', 'less/others', 'dataTables.bootstrap.less'),
		filecopy('bootstrap/3/dataTables.bootstrap.js', 'js'),
	]),

]);

task('', [
	run('copyfiles')
]);

