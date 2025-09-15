<?php

try
   { //host
    define("HOST", "localhost");

    //dbname 
    define("DBNAME", "hotel-booking");

    //user
    define("USER", "root");

    //password
    define("PASS", "1234");

    $conn = new PDO("mysql:host=".HOST.";dbname=".DBNAME."", USER, PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // if ($conn == true) {
    //     echo "Connected successfully";

    // }else {
    //     echo "Connection failed";
    // }

} catch (PDOException $e) 

{
    echo "Connection failed: " . $e->getMessage();
}

?>