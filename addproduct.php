<?php
	include('conn.php');

	$pname=$_POST['pname'];
	$price=$_POST['price'];

	$fileinfo=PATHINFO($_FILES["photo"]["name"]);

	if(empty($fileinfo['filename'])){
		$location="";
	}
	else{
	$newFilename=$fileinfo['filename'] ."_". time() . "." . $fileinfo['extension'];
	move_uploaded_file($_FILES["photo"]["tmp_name"],"upload/" . $newFilename);
	$location="upload/" . $newFilename;
	}
	
	$sql="insert into product (name, price, photo) values ('$name', '$price', '$location')";
	$conn->query($sql);

	header('location:product.php');

?>