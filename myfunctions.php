<?php
include('./dbcon.php');
function getAll($table)
{
  global $con;
  $query = "SELECT * FROM $table";

  return $query_run = mysqli_query($con, $query);
}

function getByID($table,$id)
{
  global $con;
  $query = "SELECT * FROM $table WHERE id='$id' ";

  return $query_run = mysqli_query($con, $query);
}

function getSlug($table,$slug)
{
  global $con;
  $query = "SELECT * FROM $table WHERE slug='$slug' ";

  return $query_run = mysqli_query($con, $query);
}

function getProdByCategory($category_id){
  global $con;
  $query = "SELECT * FROM products WHERE category_id='$category_id' ";

  return $query_run = mysqli_query($con, $query);
}

function redirect($url, $message)
{
  $_SESSION['message'] = $message;
  header('Location: ' . $url);
  exit();
}
