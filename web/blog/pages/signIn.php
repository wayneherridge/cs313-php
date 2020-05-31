<?php
/**********************************************************
 * File: signIn.php
 ***********************************************************/

// First check to see if we have post variables, if not, just
// continue on as always.

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = filter_input(INPUT_POST, 'txtUser', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'txtPassword');

    if (empty($username) || empty($password)) {
        $message = "Missing Login Info";
    } else {
        $query = $db->prepare('SELECT * FROM users WHERE username=:username');
        $query->execute([':username' => $username]);

        $user = $query->fetch(PDO::FETCH_ASSOC);

        $query->closeCursor();

        if (password_verify($password, $user['password'])) {
            // password was correct, put the user on the session, and redirect to home
            $_SESSION['user'] = $user;
            header("Location: {$baseURI}");
            exit; // we always include a die after redirects.
        } else {
            $message = "Incorrect username or password!";
        }
    }
}

// If we get to this point without having redirected, then it means they
// should just see the login form.
?>
<?php require $basePath . '/partials/header.php';?>

<h2>Please sign in below:</h2>

<form id="mainForm" action="<?=$baseURI;?>sign-in" method="POST">

    <input type="text" id="txtUser" name="txtUser" placeholder="Username">
    <label for="txtUser">Username</label>
    <br /><br />

    <input type="password" id="txtPassword" name="txtPassword" placeholder="Password">
    <label for="txtPassword">Password</label>
    <br /><br />

    <input type="submit" value="Sign In" />

</form>

<br /><br />

Or <a href="<?=$baseURI;?>sign-up">Sign up</a> for a new account.
<?php require $basePath . '/partials/footer.php';?>