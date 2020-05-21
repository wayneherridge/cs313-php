<?php

function get_db() {
	$db = NULL;

	// It would be better to store these in a different file
$dbUser = 'postgres';
$dbPassword = 'Password';
$dbName = 'Blog';
$dbHost = 'localhost';
$dbPort = '5432';

try
{
	// Create the PDO connection
	$db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

	// this line makes PDO give us an exception when there are problems, and can be very helpful in debugging!
	$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}
catch (PDOException $ex)
{
	// If this were in production, you would not want to echo
	// the details of the exception.
	echo "Error connecting to DB. Details: $ex";
	die();
}
	return $db;
}
?>