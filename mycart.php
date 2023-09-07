<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>My Cart</title>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="cart.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
</head>
<body style="background:linear-gradient(180deg, rgb(70, 36, 70, 0.35) 0%, rgba(176, 95, 109, 0.35) 100%);">

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

    <div class="container">
    <div class="row">
    <p class="cart-text">MY CART</p>
    <div class="col-lg-8">
    <table class="table">
        <thead class="text-center">
            <tr>
                <th scope="col">Serial no.</th>
                <th scope="col">Item name</th>
                <th scope="col">Item price</th>
                <th scope="col">Quantity</th>
								<th scope="col">Total</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody class="text-center">
        <?php
             
            if(isset($_SESSION['cart']))
            {
                foreach($_SESSION['cart'] as $key => $value)
                {   
                    $sr=$key+1;
                    echo"
                    <tr>
                    <td>$sr</td>
                    <td>$value[Item_Name]</td>
                    <td>$value[Price]<input type='hidden' class='iprice' value='$value[Price]'></td>
                    <td>
                    <form action='manage_cart.php' method='POST'>
                      <input class='text-center iquantity' name ='Mod_Quantity' onchange='subTotal();' type='number' value='$value[Quantity]' min='1' max='10'>
                        <input type='hidden' name ='Item_Name' value='$value[Item_Name]'> 
                      </form>
                    </td> 
                    <td class='itotal'>0</td>
                    <td>
                    	<form action='manage_cart.php' method='POST'>
                    		<button name='Remove_Item' class='btn btn-sm btn-outline-danger'>REMOVE </button> 
                    	<input type='hidden' name ='Item_Name' value='$value[Item_Name]'>
                    </form>
                    </td>
                    </tr>
                    "; 
                }
            }
        ?>
            

        </tbody>
    </table>
    </div>

    <div class="col-lg-3  ">
        <div class="border bg-light rounded p-4">
            <h4>Grand total: </h4>
            <h5 class="text-right" id="gtotal"></h5>
            <br>
            
            <?php if(isset($_SESSION['cart']) && count($_SESSION['cart'])>0)  
                {
            ?>

            <form action="purchase.php" method="POST">
                <div class="form-group">
                    <label>Full name</label>
                    <input type="text" name="full_name" class="form-control" required>
                </div>
                <br>
                <div class="form-group">
                    <label>Phone number</label>
                    <input type="number" name="phone_no" class="form-control" required>
                </div>
                <br>
                <div class="form-group">
                    <label>Table no.</label>
                    <input type="text" name="table_no" class="form-control" required>
                </div>
                <br>
                <button class="btn btn-primary btn-block" name="purchase">Place Order</button>
            </form>

            <?php  
                }
            ?>
        </div>
    </div>
    </div>
    </div>


    <script>
        var gt=0;
        var iprice=document.getElementsByClassName('iprice');
        var iquantity=document.getElementsByClassName('iquantity');
        var itotal=document.getElementsByClassName('itotal');
        var gtotal=document.getElementById('gtotal');
        function subTotal(){
            gt=0;
            for(i=0;i<iprice.length; i++)
            {
                itotal[i].innerText=(iprice[i].value)*(iquantity[i].value); 
                gt=gt+(iprice[i].value)*(iquantity[i].value);
            }
            
            gtotal.innerText=gt;
        }
        subTotal(); 
</script>

</body>

</html>