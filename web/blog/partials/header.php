<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog
        <?php if ($title) {echo ' | ' . $title;}?>
    </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <header>
        <h1>
            Blog <?php if ($title) {echo ' | ' . $title;}?>
        </h1>
        <?php if ($u = auth()) {
    echo 'Welcome ' . $u['username'];
}
?>
    </header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand navbar-light" href="index.php">Blog</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link <?php if ($currentPage == "Index") {?>active<?php }?>" href="index.php">Home
                        <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link <?php if ($currentPage == "About") {?>active<?php }?>" href="about.php">About Us
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link <?php if ($currentPage == "Contact") {?>active<?php }?>"
                        href="contact.php">Contact Us </a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" action="index.php" method="GET">
                <input class="form-control mr-sm-2" type="text" name="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
            <a href="#" class="btn btn-info" role="button">Login</a>
            <a href="#" class="btn btn-info" role="button">Logout</a>
            <a href="#" class="btn btn-info" role="button">Signup</a>
        </div>
    </nav>
    <?php if (isset($message)): ?>
    <div class="alert alert-danger">
        <?=$message;?>
    </div>
    <?php endif;?>
    <main>