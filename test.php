<?php

$user = array();

$user[] = [
	'name' => 'john',
	'age' => 32
];

$user[] = [
	'name' => 'megan',
	'age' => 28
];

// print_r($user);


$arr['msg'] = array();
array_push($arr['msg'], ['n'=>'ok', 'a'=>3]);
array_push($arr['msg'], ['n'=>'ok2', 'a'=>33]);
// $arr['msg'] = ['n'=>'ok2', 'a'=>33];

print_r($arr);