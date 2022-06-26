<?php

/**
 * QUESTION 3
 *
 * For each month that had sales show a list of customers ordered by who spent the most to who spent least.
 * If the totals are the same then sort by customer.
 * If a customer has multiple products then order those products alphabetical.
 * Months with no sales should not show up.
 * Show the name of the customer, what products they bought and the total they spent.
 * Only show orders with the "Payment received" and "Dispatched" status.
 * If there are no results, then it should just say "There are no results available."
 *
 * Please make sure your code runs as effectively as it can.
 *
 * See test3.html for desired result.
 */
?>
<?php
//$con holds the connection
require_once('db.php');
?>
<!DOCTYPE html>
<html>

<head>
	<title>Test3</title>
</head>

<body>
	<h1>Top Customers per Month</h1>
	<?php
	$currOrderDate = "";
	$prevOrderDate = "";
	$currCustomer = "";
	$prevCustomer = "";
	foreach ($orderArray as $order) {
		$currOrderDate = $order['order_date'];
		$currCustomer = $order['first_name'] . " " . $order['last_name'];
		if ($currOrderDate != $prevOrderDate) {
			if ($prevOrderDate) {
				echo ("</tbody></table>");
			}
			echo "<h2>" . $order['order_date'] . "</h2>";
			echo ("<table width='800'><tbody>");
			echo ("<tr><th  width='200' align='left'>Customer</th><th  width='400' align='left'>Products Bought</th><th  width='200' align='right'>Total</th></tr>");
		}
		if ($currCustomer != $prevCustomer) {
			echo ("<tr ><td align='left'>" . $order['first_name'] . " " . $order['last_name'] . "</td><td align='left'>" . $order['product'] . "</td><td align='right'>R " . number_format($order['totalPrice'], 2) . "</td></tr>");
		} else {
			echo ("<tr ><td align='left'></td><td align='left'>" . $order['product'] . "</td><td align='right'></td></tr>");
		}
		$prevCustomer = $currCustomer;
		$prevOrderDate = $currOrderDate;
	}
	?>
</body>

</html>