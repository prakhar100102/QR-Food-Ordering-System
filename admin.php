<?php

	session_start();

	if (isset($_SESSION["user_id"])) {
		
		include('./dbcon.php');
		
		$sql = "SELECT * FROM users
				WHERE id = {$_SESSION["user_id"]}";
				
		$result = $con->query($sql);
		
		$user = $result->fetch_assoc();
	}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Page</title>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!--
			<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
			<meta name="HandheldFriendly" content="true">
		-->

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	
    <style>
        body{
            font-family: poppins;
            min-height: 100vh;
            background: no-repeat;
            background-size: cover;
            background-position: center;
            padding: 0;
            margin: 0;
        }
    </style>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
</head>
<body style="background:linear-gradient(180deg, rgba(70, 36, 70, 0.35) 0%, rgba(176, 95, 109, 0.35) 100%);">


<?php if (isset($user)): ?>
    

	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="#">    One For Two Cafe</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav">
				<li class="nav-item active">
					<a class="nav-link" href="#">Home <span class="sr-only"></span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="category.php">All Category</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="products.php">All Products</a>
				</li>
			  <li class="nav-item">
					<a class="nav-link" href="add-category.php">Add Category</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="add-product.php">Add Products</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="logout.php">Log Out</a>
				</li>
				
			</ul>
		</div>
	</nav>


<div class="container mt-5"> 
	<div class="row"> 
		<div class="col-lg-12">
	<table class="table text-center table-light">
		<thead>
			<tr>
			<th scope="col">Order Id</th>				
			<th scope="col">Name</th>
			<th scope="col">Phone no.</th>
			<th scope="col">Table no.</th>
			<th scope="col">Orders</th>
			</tr>
		</thead>
		<tbody>
			<?php   
			$query="SELECT * FROM `order_manager`";
			$user_result=mysqli_query($con,$query);
			while($user_fetch=mysqli_fetch_assoc($user_result)){

				echo"
				<tr>
				<th >$user_fetch[Order_Id]</th>
				<td>$user_fetch[Full_Name]</td>
				<td>$user_fetch[Phone_No]</td>
				<td>$user_fetch[Table_No]</td>
				<td>
				<table class='table table-light'>
				<thead>
					<tr>
					<th scope='col'>Item Name</th>				
					<th scope='col'>Price</th>
					<th scope='col'>Quantity</th>
					
					</tr>
				</thead>
				<tbody>
				";
				
				$order_query="SELECT * FROM `user_orders` WHERE `Order_Id`='$user_fetch[Order_Id]'";
				$order_result=mysqli_query($con,$order_query);
				while($order_fetch=mysqli_fetch_assoc($order_result)){
					echo"
					<tr>
					<th>$order_fetch[Item_Name]</th>
					<td>$order_fetch[Price]</td>
					<td>$order_fetch[Quantity]</td>
					
					</tr>
					";
				}
				echo"
				</tbody>
				</table>
				</td>
				</tr>
				";

			}
			?>
			
				
				
		</tbody>
</table>
		</div>
	</div>
</div>


<?php else: ?>

    <div class=" text-center">
		<a class="lr" href="login.php">Log in</a> 
	</div>
    
    
<?php endif; ?>

</body>
</html>