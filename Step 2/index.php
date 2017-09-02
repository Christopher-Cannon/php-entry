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
					<input type="text" name="name" value="<?php echo $name ?>" />

					<label>Comment</label>
					<textarea name="comment"><?php echo $comment ?></textarea>

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
