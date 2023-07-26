<?php

defined('BASEPATH') OR exit('No direct script access allowed');





$active_group = 'default';

$query_builder = TRUE;



/*$hostName = 'localhost';
$dbUserName = 'dndtests_test_ecommerce';
$dbPassword = '#fNK*Uj*R@NV';;
$databaseName = 'dndtestserver_stylebuddy_23_21_march';*/

$hostName = 'localhost';
$dbUserName = 'odmuajmy_stylebuddy';
$dbPassword = 'bU3vv,LFhjAD';
$databaseName = 'odmuajmy_stylebuddy_23_april_1'; 

$db['default'] = array(

	'dsn'	=> '',

	'hostname' => 'localhost',

	'username' => $dbUserName,

	'password' => $dbPassword,

	'database' => $databaseName,

	'dbdriver' => 'mysqli',

	'dbprefix' => '',

	'pconnect' => FALSE,

	'db_debug' => (ENVIRONMENT !== 'production'),

	'cache_on' => FALSE,

	'cachedir' => '',

	'char_set' => 'utf8',

	'dbcollat' => 'utf8_general_ci',

	'swap_pre' => '',

	'encrypt' => FALSE,

	'compress' => FALSE,

	'stricton' => FALSE,

	'failover' => array(),

	'save_queries' => TRUE

);

