<?php
/**
 * QUESTION 1
 *
 * Create a form with a single textarea that will sort words or phrases alphabetically separated by commas.
 * Validate that the field is not empty.
 * Clean up the string to remove any extra spaces and unnecessary commas.
 * The result should be shown below the form.
 * Please make sure your code runs as effectively as it can.
 * The end result should look like the following:
 * apples, cars, tables and chairs, tea and coffee, zebras
 */

// Check Post is set then check the input is set.
if (isset($_POST) && !empty($_POST['to_sort'])) {
	// Clean input replace all commas and trim all whitespace left & right.
	// Explode array to split each individual line of the textarea.
	$input = explode(PHP_EOL, str_replace(',', '', trim($_POST['to_sort'])));	
	// Filter array to remove any unwanted white space entries.
	$array = array_filter($input);
	// Sort the array in alphabetical order.
	sort($array);
	// Implde sorted array back to a comma seperated string.
	$result = implode(', ', $array);
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Test1</title>
</head>
<body style="padding:10px;">
	<h1>Sort List</h1>
	<!-- Added action to post back to itself to process itself. -->
	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<input type="hidden" name="action" value="sort" />
		<label for="to_sort">Please enter the words/phrases to be sorted separated by commas:</label><br />
		<textarea name="to_sort" style="width: 400px; height: 150px;"></textarea><br />
		<input type="submit" value="Sort" />
	</form>
	<div>
		<!-- Added the result to echo after form. -->
		<?php
		if (isset($result)) {
			echo $result;
		}
		?>
	</div>
</body>

</html>