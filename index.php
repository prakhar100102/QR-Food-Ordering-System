<?php
session_start();
$mysqli = require __DIR__ . "/dbcon.php";
  $mysqli = require __DIR__ . "/myfunctions.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Minor Project - Main Page</title>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
 
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	<link rel="stylesheet" href="main.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
</head>
<body style="background:linear-gradient(180deg, rgba(70, 36, 70, 0.35) 0%, rgba(176, 95, 109, 0.35) 100%);">

<nav class="navbar">
    <div class="logo">One For Two Cafe</div>
    <ul class="nav-links">
      <input type="checkbox" id="checkbox_toggle" />
      <label for="checkbox_toggle" class="check">&#9776;</label>
      <div class="menu">
        <li><a href="index.php" class="btn">Home</a></li>
        <li class="services">
          <a class="btn">Menu</a>
          <ul class="dropdown">
            <li><a href="pastapage.html">Pasta</a></li>
            <li><a href="pizzapage.html">Pizza</a></li>
            <li><a href="souppage.html">Soup</a></li>
            <li><a href="chinesepage.html">Chinese Wok</a></li>
            <li><a href="sidespage.html">Sides</a></li>
            <li><a href="mocktailpage.html">Mocktail</a></li>
            <li><a href="coffeepage.html">Coffee</a></li>
            <li><a href="shakespage.html">Shakes</a></li>
            <li><a href="softpage.html">Soft Drinks</a></li>
            <li><a href="dessertspage.html">Desserts</a></li>
          </ul>
        </li>
        <li>
					<?php
						$count=0;
						if(isset($_SESSION['cart']))
						{
							$count=count($_SESSION['cart']);
						}
					?>
					<a href="mycart.php" class="btn">Cart (<?php echo $count; ?>)</a>
				</li>
      </div>
    </ul>
  </nav>

	<div class="clearfix">
  <?php
    $category = getAll("categories");
    if(mysqli_num_rows($category)>0){
      foreach($category as $item){
  ?>
    <a id="remove-underline" href="productpage.php?category=<?= $item['slug']; ?>">
			<div class="container">
				<div id="box" style="background-image: URL(./uploads/<?= $item['image']; ?>)">
					  <p class="text"><?= $item['name']; ?></p>
				</div>
			</div>
		</a>
  <?php  
      }
    }
    else{
    echo "No data available";
    }
  ?>
	</div>


	<footer class="text-center text-white" style="background-color: rgba(176, 95, 109, 0.8);">
  <div class="container1 pt-4">
    <section class="mb-2">
      <a
        class="btn btn-link btn-floating btn-lg text-dark m-1"
        href="https://www.facebook.com/login/"
        role="button"
        data-mdb-ripple-color="dark"
        ><i class="bi bi-facebook"></i></a>
      <a
        class="btn btn-link btn-floating btn-lg text-dark m-1"
        href="https://twitter.com/login"
        role="button"
        data-mdb-ripple-color="dark"
        ><i class="bi bi-twitter"></i></a>
      <a
        class="btn btn-link btn-floating btn-lg text-dark m-1"
        href="https://www.instagram.com/"
        role="button"
        data-mdb-ripple-color="dark"
        ><i class="bi bi-instagram"></i></a>
      <a
        class="btn btn-link btn-floating btn-lg text-dark m-1"
        href="https://in.linkedin.com/"
        role="button"
        data-mdb-ripple-color="dark"
        ><i class="bi bi-linkedin"></i></a>
      <a
        class="btn btn-link btn-floating btn-lg text-dark m-1"
        href="https://github.com/"
        role="button"
        data-mdb-ripple-color="dark"
        ><i class="bi bi-github"></i></a>
    </section>
  </div>
  <div class="text-center text-light p-3" style="background-color: rgba(70, 36, 70, 0.8);">
    © 2023 Copyright : Team Two
  </div>
</footer>


</body>
</html>