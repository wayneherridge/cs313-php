<?php
/**********************************************************
* File: signOut.php
***********************************************************/

include("admin/config.php");

//require("password.php"); // used for password hashing.
session_start();
unset($_SESSION['username']);

header("Location: admin/signIn.php");
die(); // we always include a die after redirects.