<?php

session_start();

$con = mysqli_connect("localhost", "root", "", "final");

if(mysqli_connect_error()){
    echo "<script>
            alert('cannot connect to the database'); 
            window.location.href='mycart.php';
            </script>";

            exit();
}


if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(isset($_POST['purchase'])){
        
        $query1="INSERT INTO `order_manager`( `Full_Name`, `Phone_No`, `Table_No`) VALUES ('$_POST[full_name]','$_POST[phone_no]','$_POST[table_no]')";
        if(mysqli_query($con,$query1)){
            
            $Order_Id=mysqli_insert_id($con);
            $query2="INSERT INTO `user_orders`(`Order_Id`, `Item_Name`, `Price`, `Quantity`) VALUES (?,?,?,?)";
            $stmt=mysqli_prepare($con, $query2);
            if($stmt){
                mysqli_stmt_bind_param($stmt, "isii", $Order_Id, $Item_Name, $Price, $Quantity); 
                foreach($_SESSION['cart'] as $key => $values)
                {
                    $Item_Name=$values['Item_Name'];
                    $Price=$values['Price'];
                    $Quantity=$values['Quantity'];
                    mysqli_stmt_execute($stmt);
                }
                unset($_SESSION['cart']);
                echo "<script>
                    alert('Order Placed Successfully'); 
                    window.location.href='index.php';
                    </script>";
                }
            else{
                echo "<script>
                alert('SQL Query Prepare Error'); 
                window.location.href='mycart.php';
                </script>";
            }
        }
        else{
            echo "<script>
            alert('SQL error'); 
            window.location.href='mycart.php';
            </script>";
        }
    }
}