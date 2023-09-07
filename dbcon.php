<?php  
    $host = "localhost";
    $dbname = "final";
    $username = "root";
    $password = "";
    
    
    $con = new mysqli(hostname: $host,
                      username: $username,
                      password: $password,
                      database: $dbname);
        
                
    if ($con->connect_errno) {
        die("Connection error: " . $con->connect_error);
    }
                    
    return $con;