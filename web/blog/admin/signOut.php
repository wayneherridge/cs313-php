<?php
/**********************************************************
* File: signOut.php
***********************************************************/

require("password.php"); // used for password hashing.
session_start();
unset($_SESSION['username']);

header("Location: signIn.php");
die(); // we always include a die after redirects.