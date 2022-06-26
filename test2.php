<?php

/**
 * QUESTION 2
 *
 * Using the data stored in the database
 * show a list of products with their prices
 * grouped by category.
 * The categories should be listed in alphabetical order.
 * The products within those categories should also be listed in alphabetical order.
 * Products with no category will be categorized as "Uncategorized".
 * If there are no results, then it should just say "There are no results available."
 *
 * Please make sure your code runs as effectively as it can.
 *
 * See test2.html for desired result.
 */
?>
<?php
//$con holds the connection
require_once('db.php');
?>
<!DOCTYPE html>
<html>

<head>
	<title>Test2</title>
</head>

<body>
	<h1>Products</h1>
	<?php
	$currCategory = "";
	$prevCategory = "";
	$uncategorized = "";
	if (!empty($noResult)) {
		foreach ($data as $category) {
			if ($category['category']) {
				$currCategory = $category['category'];
				if ($currCategory != $prevCategory) {
					if ($prevCategory) {
						echo ("</tbody></table>");
					}
					echo ("<h2>" . $category['category'] . "</h2>");
					echo ("<table width='400'><tbody>");
					echo ("<tr><th align='left'>Product</th><th align='right'>Price</th></tr>");
				}
				echo ("<tr><td align='left'>" . $category['product'] . "</td><td align='right'>R " . number_format($category['price'], 2) . "</td></tr>");
				$prevCategory = $currCategory;
			} else {
				$uncategorized .= ("<tr><td align='left'>" . $category['product'] . "</td><td align='right'>R " . number_format($category['price'], 2) . "</td></tr>");;
			}
		}
		if ($uncategorized) {
			echo ("</tbody></table>");
			echo ("<h2>Uncategorized</h2>");
			echo ("<table width='400'><tbody>");
			echo ("<tr><th align='left'>Product</th><th align='right'>Price</th></tr>");
			echo ($uncategorized);
			echo ("</tbody></table>");
		}
	} else {
		echo ("There are no products to display.");
	}
	?>
</body>

</html>