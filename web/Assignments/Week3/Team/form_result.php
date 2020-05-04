<?php 
	$name = htmlspecialchars($_POST["name"]);
	$email = htmlspecialchars($_POST["email"]);
	$major = htmlspecialchars($_POST["major"]);
	$places = $_POST["places"];
	$comments = htmlspecialchars($_POST["comments"]);
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Form Results</title>
	</head>

<body>
	<h3>Form Results</h3>

	<p>Name: <?=$name ?></p>
	<p>Email <a href="mailto:<?=$email ?>"><?=$email ?></a></p>
	<p>major: <?=$major ?></p>
	<p>destinations:</p>

	<ul>
		<?php
		foreach ($places as $place) {
		$place_clean = htmlspecialchars($place);
		echo "<li><p>$place_clean</p></li>";
		}
		?>
	</ul>
</body>

</html>