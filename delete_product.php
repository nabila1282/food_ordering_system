<?php
	include('conn.php');

	$id = $_GET['product'];

	$sql="delete from product where pid='$id'";
	$conn->query($sql);

	header('location:product.php');
?>