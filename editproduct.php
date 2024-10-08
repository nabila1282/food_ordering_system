<?php
	include('conn.php');

	$id=$_GET['product'];

	$name=$_POST['name'];
	$price=$_POST['price'];

	$sql="select * from product where pid='$id'";
	$query=$conn->query($sql);
	$row=$query->fetch_array();

	$fileinfo=PATHINFO($_FILES["photo"]["name"]);

	if (empty($fileinfo['filename'])){
		$location = $row['photo'];
	}
	else{
		$newFilename=$fileinfo['filename'] ."_". time() . "." . $fileinfo['extension'];
		move_uploaded_file($_FILES["photo"]["tmp_name"],"upload/" . $newFilename);
		$location="upload/" . $newFilename;
	}

	$sql="update product set name='$name', price='$price', photo='$location' where pid='$id'";
	$conn->query($sql);

	header('location:product.php');
?>