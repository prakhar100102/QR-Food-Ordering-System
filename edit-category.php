<?php

session_start();

if (isset($_SESSION["user_id"])) {
  
  $mysqli = require __DIR__ . "/dbcon.php";
  $mysqli = require __DIR__ . "/myfunctions.php";

}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Add category Page</title>
	<link rel="stylesheet" href="main.css">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!--
			<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
			<meta name="HandheldFriendly" content="true">
		-->

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>
<body style="background:aquamarine;">
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
      <div class="col-md-16">
        <?php 
          if(isset($_GET['id'])){
            $id= $_GET['id'];
            $category=getByID("categories",$id);
            if(mysqli_num_rows($category)>0){
              $data = mysqli_fetch_array($category);
            
        ?>
          <div class="card">
            <div class="card-header text-center"> 
              <h4>Edit Category</h4>
            </div>
            <div class="card-body">
              <form action="code.php" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12 mt-2">
                      <input type="hidden" name="category_id" value="<?= $data['id'] ?>">
                      <label for="">Name</label> 
                      <input type="text" name="name" value=<?= $data['name']; ?> placeholder="Enter category name" class="form-control">
                    </div>  
                    <div class="col-md-12 mt-2">
                    <label for="">Slug</label> 
                      <input type="text" name="slug" value="<?= $data['slug']; ?>" placeholder="Enter slug" class="form-control">
                    </div>
                    <div class="col-md-12 mt-3">
                      <label for="">Upload Image</label> 
                      <input type="file" name="image" class="form-control">
                      <label for="">Current Image</label> 
                      <input type="hidden" name="old_image" value="<?= $data['image']; ?>">
                      <img src="./uploads/<?= $data['image']; ?>" width="50px" height="50px" alt="">
                    </div>
                    <br>  
                    <div class="col-md-12 mt-3"> 
                      <button type="submit" class="btn btn-primary" name="update_category_btn">Update</button> 
                    </div>

                </div>
              </form>    
            </div>            
          </div>
        <?php
            }
            else{
              echo"Category not found";
            } 
        }
        else{
          echo"ID missing from url";
        }
        ?>
      </div>
    </div>
  </div>


</body>
</html>