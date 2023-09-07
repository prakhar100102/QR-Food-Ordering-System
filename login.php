<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/dbcon.php";
    
    $sql = sprintf("SELECT * FROM users
                    WHERE email = '%s'",
                   $mysqli->real_escape_string($_POST["email"]));
    
    $result = $con->query($sql);
    
    $user = $result->fetch_assoc();
    
    if ($user) {
        
        if (password_verify($_POST["password"], $user["password_hash"])) {
            
            
            session_start();
            
            session_regenerate_id();
            
            $_SESSION["user_id"] = $user["id"];
            
            header("Location: admin.php");
            exit;        
        }
    }
    
    $is_invalid = true;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <style>
        body{
            font-family: poppins;
            min-height: 100vh;
            background: no-repeat;
            background-size: cover;
            background-position: center;
        }
				h1{
					font-family: poppins;
					color: #000000;
				}
				label{
					font-family: poppins;
					color: #000000;
					text-align: center; 
				}
				input{
					font-family: poppins;
					color: #000000;
					text-align: center; 
					font-size
				}
				button{
					font-family: poppins;
					text-align: center; 
				}
				.container{
					float: center;
					padding-left: 300px;
				}
				.clearfix::after{
					top: 90px;
					content: "";
					clear: both;
				}
    </style>
</head>
<body style="background:linear-gradient(180deg, rgba(70, 36, 70, 0.35) 0%, rgba(176, 95, 109, 0.35) 100%);">
    
	<div class="clearfix">
		<div class="container">
    <h1>Login</h1>
    
    <?php if ($is_invalid): ?>
        <em>Invalid login</em>
    <?php endif; ?>
    
    <form method="post">
        <label for="email">E-mail</label>
        <input type="email" name="email" id="email"
            value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
        
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        
        <button>Log in</button>
    </form>
		</div>
	</div>
</body>
</html>







