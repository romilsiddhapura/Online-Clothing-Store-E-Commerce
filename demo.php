
<?php
	$conn = mysqli_connect("localhost", "root", "root", "clothing"); //keep your db name
	$sql = "SELECT * FROM products WHERE id = 1";
	$sth = $conn->query($sql);
	$result=mysqli_fetch_array($sth);
	echo '<img src="data:image/jpeg;base64,'.base64_encode( $result['product_image'] ).'"/>';

?>