<?php
$con = mysqli_connect("localhost", "root", "root", "devtest");

if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

if ($result = $con->query("SELECT category_id,product,price,products.id,category,categories.id 
FROM products
LEFT OUTER JOIN categories ON products.category_id = categories.id
ORDER BY category,category_id desc,product asc;
")) {
	$data = [];
	while ($row = mysqli_fetch_array($result)) {
		array_push($data,$row);
	}
	if ($data) {
		$noResult = "There are no results";
	}
	$result->free_result();
}

if ($result = $con->query("SELECT (
	SELECT Sum(products.price) FROM order_items 
	INNER JOIN orders ON order_id = orders.id
	INNER JOIN products ON product_id = products.id
	WHERE orders.order_status_id IN (2,3) AND user_id= u.id AND extract(YEAR_MONTH FROM orders.order_date)=extract(YEAR_MONTH FROM o.order_date)
	GROUP BY user_id
	) totalPrice, product,first_name,last_name,o.order_date 
	FROM order_items 
	INNER JOIN orders o ON o.id = order_id
	INNER JOIN products ON products.id = product_id 
	INNER JOIN users u ON u.id = o.user_id
	WHERE o.order_status_id IN (2,3) AND user_id
	ORDER BY extract(YEAR_MONTH FROM o.order_date),totalPrice desc,u.first_name asc,products.product asc;
")) {
	$orderArray = [];
	while ($row = mysqli_fetch_array($result)) {
		$date= $date = date_create($row['order_date']);
		$row['order_date']=date_format($date,'F Y');
		array_push($orderArray, $row);
	}
	$result->free_result();
}
