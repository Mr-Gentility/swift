<?php
// *************************************************************************
// *                                                                       *
// * DEPRIXA -  Integrated Web system                                      *
// * Copyright (c) JAOMWEB. All Rights Reserved                            *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * Email: osorio2380@yahoo.es                                            *
// * Website: http://www.jaom.info                                         *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * This software is furnished under a license and may be used and copied *
// * only  in  accordance  with  the  terms  of such  license and with the *
// * inclusion of the above copyright notice.                              *
// * If you Purchased from Codecanyon, Please read the full License from   *
// * here- http://codecanyon.net/licenses/standard                         *
// *                                                                       *
// *************************************************************************
 


// database connection config

error_reporting(E_ERROR | E_WARNING | E_PARSE);
require('config.php');

if (!function_exists('get_magic_quotes_gpc')) {
	function get_magic_quotes_gpc()
	{
		return false;
	}
}

if (!defined('MYSQL_NUM')) {
	define('MYSQL_NUM', 1);
}
if (!defined('MYSQL_ASSOC')) {
	define('MYSQL_ASSOC', 2);
}
if (!defined('MYSQL_BOTH')) {
	define('MYSQL_BOTH', 3);
}

if (!function_exists('mysql_connect')) {
	$GLOBALS['__legacy_mysql_link'] = null;

	function mysql_connect($host, $user, $password)
	{
		$link = mysqli_connect($host, $user, $password);
		if ($link) {
			$GLOBALS['__legacy_mysql_link'] = $link;
		}
		return $link;
	}

	function mysql_select_db($database_name, $link_identifier = null)
	{
		$link = $link_identifier ?: $GLOBALS['__legacy_mysql_link'];
		return mysqli_select_db($link, $database_name);
	}

	function mysql_query($query, $link_identifier = null)
	{
		$link = $link_identifier ?: $GLOBALS['__legacy_mysql_link'];
		return mysqli_query($link, $query);
	}

	function mysql_error($link_identifier = null)
	{
		$link = $link_identifier ?: $GLOBALS['__legacy_mysql_link'];
		return $link ? mysqli_error($link) : mysqli_connect_error();
	}

	function mysql_affected_rows($link_identifier = null)
	{
		$link = $link_identifier ?: $GLOBALS['__legacy_mysql_link'];
		return mysqli_affected_rows($link);
	}

	function mysql_fetch_array($result, $result_type = MYSQL_BOTH)
	{
		if (!$result) {
			return null;
		}
		if ($result_type === MYSQL_NUM) {
			return mysqli_fetch_array($result, MYSQLI_NUM);
		}
		if ($result_type === MYSQL_ASSOC) {
			return mysqli_fetch_array($result, MYSQLI_ASSOC);
		}
		return mysqli_fetch_array($result, MYSQLI_BOTH);
	}

	function mysql_fetch_assoc($result)
	{
		return $result ? mysqli_fetch_assoc($result) : null;
	}

	function mysql_fetch_row($result)
	{
		return $result ? mysqli_fetch_row($result) : null;
	}

	function mysql_free_result($result)
	{
		return $result ? mysqli_free_result($result) : false;
	}

	function mysql_num_rows($result)
	{
		return $result ? mysqli_num_rows($result) : 0;
	}

	function mysql_insert_id($link_identifier = null)
	{
		$link = $link_identifier ?: $GLOBALS['__legacy_mysql_link'];
		return mysqli_insert_id($link);
	}

	function mysql_real_escape_string($unescaped_string, $link_identifier = null)
	{
		$link = $link_identifier ?: $GLOBALS['__legacy_mysql_link'];
		return mysqli_real_escape_string($link, $unescaped_string);
	}

	function mysql_escape_string($unescaped_string)
	{
		return mysql_real_escape_string($unescaped_string);
	}
}

$dbConn = mysql_connect($db_host, $db_user, $db_password) or die('MySQL connect failed. ' . mysql_error());
mysql_select_db($db_name) or die('Cannot select database. ' . mysql_error());

// Fix MySQL strict mode default value errors
mysql_query("SET SESSION sql_mode='NO_ENGINE_SUBSTITUTION'");

// Set charset
mysql_query("SET NAMES 'utf8'");

function dbQuery($sql)
{
	$result = mysql_query($sql) or die(mysql_error());	
	return $result;
}

function dbAffectedRows()
{
	global $dbConn;	
	return mysql_affected_rows($dbConn);
}

function dbFetchArray($result, $resultType = MYSQL_NUM) {
	return mysql_fetch_array($result, $resultType);
}

function dbFetchAssoc($result)
{
	return mysql_fetch_assoc($result);
}

function dbFetchRow($result) 
{
	return mysql_fetch_row($result);
}

function dbFreeResult($result)
{
	return mysql_free_result($result);
}

function dbNumRows($result)
{
	return mysql_num_rows($result);
}

function dbSelect($dbName)
{
	return mysql_select_db($dbName);
}

function dbInsertId()
{
	return mysql_insert_id();
}

?>
