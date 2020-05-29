<?php
	switch ($_SERVER["SCRIPT_NAME"]) {
		case "/details.php":
			$CURRENT_PAGE = "Details"; 
			$PAGE_TITLE = "Blog Details";
			break;
		case "/about.php":
			$CURRENT_PAGE = "About"; 
			$PAGE_TITLE = "About Us";
			break;
		case "/contact.php":
			$CURRENT_PAGE = "Contact"; 
			$PAGE_TITLE = "Contact Us";
			break;
		case "admin/signIn.php":
			$CURRENT_PAGE = "SignIn";
			$PAGE_TITLE = "Sign In";
			break;
		case "admin/signUp.php":
			$CURRENT_PAGE = "SignUp";
			$PAGE_TITLE = "Sign Up";
			break;
		case "admin/add-post.php":
			$CURRENT_PAGE = "AddPost";
			$PAGE_TITLE = "Add Post";
			break;
		default:
			$CURRENT_PAGE = "Index";
			$PAGE_TITLE = "Home";
	}
?>