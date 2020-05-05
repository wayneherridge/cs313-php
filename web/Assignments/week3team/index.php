<?php
$majors = [
  'cs' => 'Computer Science',
  'wdd' => 'Web Design and Development',
  'cit' => 'Computer Information Technology',
  'ce' => 'Computer Engineering'
];

$countries = [
  "na" => "North America",
  "sa" => "South America",
  "eu" => "Europe",
  "as" => "Asia",
  "au" => "Australia",
  "af" => "Africa",
  "an" => "Antartica"
]
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Teach03</title>
</head>
<body>
    <form action="form_result.php" method="POST">
        <label for="name">Name: </label>
        <input type="text" name="name"><br>
        
        <label for="email">Email: </label>
        <input type="text" name="email"><br>
        
        <label for="major">Major:</label><br>
        <?php foreach($majors as $code => $name): ?>
          <input type="radio" id="<?= $code; ?>"  name="major" value="<?= $name; ?>"><?= $name; ?><br>
        <?php endforeach; ?>

        <label for="comments">Comments:</label><br> 
        <textarea name="comments"></textarea> <br><br>
        
        Visited Countries:<br>
        <?php foreach($countries as $code => $name): ?>
          <input type="checkbox" id="<?= $code; ?>"  name="visited[<?= $code ?>]" value="<?= $name; ?>"><?= $name; ?><br>
        <?php endforeach; ?>

        <input type="submit" value="Send Details">
    </form>
</body>
</html>