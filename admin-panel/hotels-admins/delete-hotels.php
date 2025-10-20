<?php


    require '../../config/config.php';

if(isset($_GET['id'])){




    $hotel_id = $_GET['id'];

    $getImage = $conn->query("SELECT * FROM hotels WHERE id = '$hotel_id'");
    $getImage->execute();

    $fetch = $getImage->fetch(PDO::FETCH_ASSOC);

    unlink("admin-panel/hotels-admins/hotels-images/".$fetch['image']);

    
    $delete = $conn->prepare("DELETE FROM hotels WHERE id = :id");
    $delete->execute([":id" => $hotel_id]);

    header("Location: show-hotels.php");
    exit();
}

?>