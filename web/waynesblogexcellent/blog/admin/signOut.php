<?php
/**********************************************************
* File: signOut.php
***********************************************************/

session_start();
unset($_SESSION['username']);

header("Location: signIn.php");
die(); // we always include a die after redirects.
