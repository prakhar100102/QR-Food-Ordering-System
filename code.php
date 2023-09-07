<?php
session_start();
$mysqli = require __DIR__ . "/dbcon.php";

if(isset($_POST['add_category_btn'])){
  $name=$_POST['name'];
  $image=$_FILES['image']['name'];
  $path="./uploads";
  $image_ext=pathinfo($image, PATHINFO_EXTENSION);
  $filename= time().'.'.$image_ext;
  $slug=$_POST['slug'];
  $cate_query="INSERT INTO `categories`( `name`, `slug`, `image`) VALUES ('$name','$slug','$filename')";
  $cate_query_run= mysqli_query($mysqli, $cate_query);

  if($cate_query_run){
    move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$filename);
    
    echo "<script>
            alert('Category Added Successfully'); 
            window.location.href='add-category.php';
          </script>";

  }
  else{
    echo "<script>
            alert('Something went wrong'); 
            window.location.href='add-category.php';
          </script>";
  }
}

else if(isset($_POST['update_category_btn'])){
  $category_id= $_POST['category_id'];
  $name=$_POST['name'];
  $slug=$_POST['slug'];
  $new_image=$_FILES['image']['name'];
  $old_image=$_POST['old_image'];

  if($new_image != "")
  {
    $update_filename = $new_image;
  }
  else
  {
    $update_filename = $old_image;
  }
  $path="./uploads";
  $update_query= "UPDATE `categories` SET `name`='$name', `slug`='$slug', `image`='$update_filename' WHERE id='$category_id' ";
  $update_query_run = mysqli_query($mysqli, $update_query);
  if($update_query_run){
    if($_FILES['image']['name'] != ""){
      move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$new_image);
      if(file_exists("uploads/".$old_image)){
        unlink("uploads/".$old_image);
      }
    }
    echo "<script>
            alert('Category updated successfully'); 
            window.location.href='category.php';
          </script>";
  }
  else{
    echo "<script>
            alert('Something went wrong'); 
            window.location.href='edit-category.php?id=$category_id';
          </script>";
  }
}

else if(isset($_POST['delete_category_btn'])){
  $category_id = mysqli_real_escape_string($con, $_POST['category_id']);

  $category_query = "SELECT * FROM categories WHERE id='$category_id'";
  $category_query_run = mysqli_query($mysqli, $category_query); 
  $category_data = mysqli_fetch_array($category_query_run); 
  $image = $category_data['image'];

  $delete_query = "DELETE FROM categories WHERE id='$category_id' "; 
  $delete_query_run = mysqli_query($mysqli, $delete_query);
  if ($delete_query_run){
    if(file_exists("uploads/".$image)){
      unlink("uploads/".$image);
    }
    echo "<script>
            alert('Category deleted successfully'); 
            window.location.href='category.php';
          </script>";
  }
  else{
    echo "<script>
            alert('Something went wrong'); 
            window.location.href='category.php';
          </script>";
  }
}

else if(isset($_POST['add_product_btn'])){
  $category_id= $_POST['category_id'];
  $name=$_POST['name'];
  $price=$_POST['price'];
  
  $product_query="INSERT INTO products (category_id,name,price) VALUES ('$category_id','$name','$price')";
  $product_query_run = mysqli_query($mysqli, $product_query);
  if($product_query_run){
    echo "<script>
            alert('Product added successfully'); 
            window.location.href='add-product.php';
          </script>";
  }
  else{
    echo "<script>
            alert('Something went wrong'); 
            window.location.href='add-product.php';
          </script>";
  }
}

else if(isset($_POST['update_product_btn'])){
  $product_id= $_POST['product_id'];
  $category_id= $_POST['category_id'];
  $name=$_POST['name'];
  $price=$_POST['price'];
  
  $update_product_query="UPDATE products SET category_id='$category_id' , name='$name', price= '$price' WHERE id='$product_id'";
  $update_product_query_run = mysqli_query($mysqli, $update_product_query);
  if($update_product_query_run){
    echo "<script>
            alert('Product updated successfully'); 
            window.location.href='products.php';
          </script>";
  }
  else{
    echo "<script>
            alert('Something went wrong'); 
            window.location.href='edit-product.php?id=$product_id';
          </script>";
  }  
}
?>