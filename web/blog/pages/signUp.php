<?php
/**********************************************************
 * File: createAccount.php
 ***********************************************************/

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // get the data from the POST
    $username = filter_input(INPUT_POST, 'txtUser', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'txtPassword');

    if (empty($username) || empty($password)) {
        $message = "Missing Registeration Info";
    } else {
        // UNIQUE CHECK
        $query = $db->prepare('SELECT * FROM users WHERE username = :username');

        $query->execute([':username' => $username]);

        $result = $query->rowCount();

        $query->closeCursor();

        if ($result) {
            $message = "Username already exists";
            exit;
        } else {
            // Get the hashed password.
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $query = $db->prepare('INSERT INTO users (username, password) VALUES (:username, :password)');

            $query->execute([':username' => $username, ':password' => $hashedPassword]);

            $result = $query->rowCount();

            $query->closeCursor();

            if ($result) {
                header("Location: {$baseURI}sign-in");
                exit;
            } else {
                $message = "Failed to create User";
                exit;
            }
        }

        // finally, redirect them to the sign in page
        // we always include a die after redirects. In this case, there would be no
        // harm if the user got the rest of the page, because there is nothing else
        // but in general, there could be things after here that we don't want them
        // to see.
    }
}

?>
<?php require $basePath . '/partials/header.php';?>

<form id="mainForm" action="<?=$baseURI;?>sign-up" method="POST">

    <input type="text" id="txtUser" name="txtUser" placeholder="Username">
    <label for="txtUser">Username</label>
    <br /><br />

    <input type="password" id="txtPassword" name="txtPassword" placeholder="Password"></input>
    <label for="txtPassword">Password</label>
    <br /><br />

    <input type="submit" value="Create Account" />

</form>

<?php require $basePath . '/partials/footer.php';?>