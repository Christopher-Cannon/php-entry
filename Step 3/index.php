<?php
$name = $comment = "";
$form_error = "";
// Remove unnecessary chars, slashes and sanitise special characters
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// If form has been submitted, we can validate the input
if($_SERVER["REQUEST_METHOD"] == "POST") {
	// Validate name
	if(empty($_POST["name"])) {
		$form_error = "All form inputs are required";
	} else {
		$name = test_input($_POST["name"]);
	}

	// Validate comment
	if(empty($_POST["comment"])) {
		$form_error = "All form inputs are required";
	} else {
		$comment = test_input($_POST["comment"]);
	}

	// If no errors are present, insert information into database
	if($form_error == "") {
		// Database credentials
		$db_server = "localhost";
		$db_user = "root";
		$db_pass = "";
		$db_name = "php_entry";
		// Get current date time (UTC)
		date_default_timezone_set('UTC');
		$datetime = date('d/m/y(D) H:i:s');

		// Connect to database
		$conn = new mysqli($db_server, $db_user, $db_pass, $db_name);

		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		// Insert name, comment and date/time
		$stmt = $conn->prepare("INSERT INTO comments (comment_name, comment_body, comment_time) VALUES (?, ?, ?)");
		$stmt->bind_param("sss", $name, $comment, $datetime);
		$stmt->execute();
		$stmt->close();

		// Close the connection
		$conn->close();
	}
}
?>

<!doctype html>

<html>
	<head>
		<title>Database entry</title>

		<meta charset="UTF-8">

		<link rel="stylesheet" type="text/css" href="css/style.css" />
	</head>

	<body>
		<div class="main-wrapper">
			<h1>Leave a comment</h1>

			<div class="form-wrapper">
				<!-- Add form name, method and action, echo form values on error -->
				<form name="comment-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
					<label>Name</label>
					<input type="text" name="name" value="<?php echo $name; ?>" />

					<label>Comment</label>
					<textarea name="comment"><?php echo $comment; ?></textarea>

					<input type="submit" name="submit" value="Submit" />
				</form>

				<!-- Add area for form error display -->
				<p class="form-error"><?php echo $form_error; ?></p>
			</div>

			<div class="comment-list">

			</div>
		</div>
	</body>
</html>
