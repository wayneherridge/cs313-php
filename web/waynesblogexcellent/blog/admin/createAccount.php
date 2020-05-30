<?php
/**********************************************************
* File: createAccount.php
***********************************************************/

// get the data from the POST
$username = $_POST['txtUser'];
$password = $_POST['txtPassword'];

if (!isset($username) || $username == ""
	|| !isset($password) || $password == "")
{
	header("Location: signUp.php");
	die(); // we always include a die after redirects.
}

$username = htmlspecialchars($username);

// Get the hashed password.
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Connect to the database
require("/db/dbConnect.php");
$db = get_db();

$query = 'INSERT INTO usertable(username, password) VALUES(:username, :password)';
$statement = $db->prepare($query);
$statement->bindValue(':username', $username);

// **********************************************
// NOTICE: We are submitting the hashed password!
// **********************************************
$statement->bindValue(':password', $hashedPassword);

$statement->execute();

// finally, redirect them to the sign in page
header("Location: admin/signIn.php");
die(); // we always include a die after redirects. In this case, there would be no
       // harm if the user got the rest of the page, because there is nothing else
       // but in general, there could be things after here that we don't want them
       // to see.

?>