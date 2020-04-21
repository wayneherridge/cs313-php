<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/normalize.css">
  </head>
  <body>
    <div class="wrapper">
    <!-- header.php -->
    <?php include 'shared/header.php' ?>

    <!-- nav.php -->
    <?php include 'shared/nav.php'; ?>

    <article class="content">
    <h1>Main article area</h1>
            <p>In this layout, we display the areas in source order for any screen less that 500 pixels wide. We go to a two column layout, and then to a three column layout by redefining the grid, and the placement of items on the grid.</p>
    </article>

    <!-- footer.php -->
    <?php include 'shared/footer.php';?>

</div>

    <!-- link to JS scripts -->
    <script src="js/scripts.js"></script>
  </body>
</html>
