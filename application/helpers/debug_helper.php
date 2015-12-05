<?php
function debug($var){
	echo "<h1>Dubug data</h1><pre>";
	print_r($var);
	echo "</pre>";
	exit();
}
function debug_continue($var){
	echo "<h1>Dubug data</h1><pre>";
	print_r($var);
	echo "</pre>";
}
?>