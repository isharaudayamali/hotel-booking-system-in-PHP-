<?php


    require '../../config/config.php';

if(isset($_GET['id'])){




    $room_id = $_GET['id'];

    $getImage = $conn->query("SELECT * FROM rooms WHERE id = '$room_id'");
    $getImage->execute();

    $fetch = $getImage->fetch(PDO::FETCH_ASSOC);

    unlink("admin-panel/rooms-admins/room-images/".$fetch['image']);


    $delete = $conn->prepare("DELETE FROM rooms WHERE id = :id");
    $delete->execute([":id" => $room_id]);

    header("Location: show-rooms.php");
    exit();
}

?>