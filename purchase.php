<?php
	include('conn.php');
	if(isset($_POST['pid'])){
 
		$customer=$_POST['customer'];
		$sql="insert into purchase (customer, date) values ('$customer', NOW())";
		$conn->query($sql);
		$pr_id=$conn->insert_id;
 
		$total=0;
 
		foreach($_POST['pid'] as $product):
		$proinfo=explode("||",$product);
		$pid=$proinfo[0];
		$iterate=$proinfo[1];
		$sql="select * from product where pid='$pid'";
		$query=$conn->query($sql);
		$row=$query->fetch_array();
 
		if (isset($_POST['quantity_'.$iterate])){
			$subt=$row['price']*$_POST['quantity_'.$iterate];
			$total+=$subt;

			$sql="insert into purchase_detail (pr_id, pid, quantity) values ('$pr_id', '$pid', '".$_POST['quantity_'.$iterate]."')";
			$conn->query($sql);
		}
		endforeach;
 		
 		$sql="update purchase set total='$total' where pr_id='$pr_id'";
 		$conn->query($sql);
		header('location:sales.php');		
	}
	else{
		?>
		<script>
			window.alert('Please select a product');
			window.location.href='order.php';
		</script>
		<?php
	}
?>