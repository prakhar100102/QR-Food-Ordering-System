<?php
  $mysqli = require __DIR__ . "/myfunctions.php";
?>

<!DOCTYPE html>
<html>
<head>
  <title>All categories</title>

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

<body>
<body style="background:linear-gradient(180deg, rgba(70, 36, 70, 0.35) 0%, rgba(176, 95, 109, 0.35) 100%);">

<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="#">    One For Two Cafe</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav">
				<li class="nav-item active">
					<a class="nav-link" href="admin.php">Home <span class="sr-only"></span></a>
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
      <div class="col-md-18">
        <div class="card">
          <div class="card-header">
            <h4>Products</h4>
          </div>   
          <div class="card-body">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Price</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr> 
              </thead>
              <tbody>
                <?php
                  $products = getAll("products");
                  if(mysqli_num_rows($products)>0){
                    foreach($products as $item){
                      ?>
                        <tr>
                          <td><?= $item['id']; ?></td>
                          <td><?= $item['name']; ?></td>
                          <td><?= $item['price']; ?></td>
                          <td>
                            <a href="edit-product.php?id=<?= $item['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                            
                          </td>
                          <td>
                            <form action="code.php" method="POST">
                              <input type="hidden" name="product_id" value="<?= $item['id']; ?>">
                              <button type="submit" class="btn btn-sm btn-danger" name="delete_product_btn">Delete</button>
                            </form>
                          </td>
                        </tr>
  
                      <?php  
                    }
                  }
                  else{
                    echo "No records found";
                  }
                ?>
              </tbody>
            </table>
          </div>        
        </div>
      </div>
    </div>
  </div>
</body>
</html>