<?php 
require("system/session.php");
require("system/check_login.php");

if($_SERVER["REQUEST_METHOD"]=="POST") {
    //we want matching id's to the article cover picture, so we get the latest id from the DB and adding +1 to it
    $row_id_query=$conn->prepare("SELECT id+1 AS id FROM car_articles ORDER BY id DESC LIMIT 1");
    $row_id_query->execute();
    $result=$row_id_query->get_result();
    $row_id=$result->fetch_assoc();
    //this "if" is usually used once, when the table is empty, it's automatically returns 1
    if ($row_id["id"] == "" || $row_id["id"] == null) {
        $row_id["id"] = 1;
    }
    //we are storing all article covers in one folder
    //any other pictures in the articles are stored separately in the user's directory
    $target_dir = "img/";

    //uploading a picture is not required, so we are checking here is there's an image present at the upload or not
    if ($_FILES["fileToUploadThumb"]["name"] == NULL) {
        $sqlfilename = NULL;
    } else {
        //we are doing a file check here
        //we are checking if the file is a jpg or png or gif
        $is_image = in_array(exif_imagetype($_FILES["fileToUploadThumb"]["tmp_name"]), array(IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF));
        $is_small = false;
        //checking for 2200kb (~2mb) size, we let the user have a little overhead on the file sizes
        //why 2megs on a small file like this? Because gifs are cool tho
        if (filesize($_FILES["fileToUploadThumb"]["tmp_name"]) < 2200000) {
            $is_small = true;
        }
        //if one of the file types is true and it's below 2200kb, we are uploading the file
        if ($is_image && $is_small) {
            //if yes, we are renaming the file to, example: stream1.jpg
            $newfilename = 'car'.$row_id["id"].'.' . end(explode('.',$_FILES["fileToUploadThumb"]["name"]));
            $sqlfilename = $target_dir . $newfilename;
            $sqlfilename = strtolower($sqlfilename);
            move_uploaded_file($_FILES["fileToUploadThumb"]["tmp_name"], $sqlfilename);
        }
    }
    $form_carname=$_POST['car_name'];
    $form_price=$_POST['price'];
    $form_location=$_POST['location'];
    $form_phonenumber=$_POST['phone_number'];
    $form_description=$_POST['description'];
    $form_picture=$sqlfilename;
    $sql_read=$conn->prepare("INSERT INTO car_articles (car_name, price, location, phone_number, description, picture) values (?, ?, ?, ?, ?, ?)");
    $sql_read->bind_param("ssssss", $form_carname, $form_price, $form_location, $form_phonenumber, $form_description, $form_picture);
    if($sql_read->execute()==true){
        header("Location: /");
    } else{
        echo "error: ".$sql_read."<br>".$conn->error;
    }
}
?>

<!DOCTYPE HTML>
<html> 
    <head>
        <title>Új Autó Hírdetése</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="editarticle.css">

    </head>

    <body>
        <?php
        require("components/header.php");
        ?>
        <form autocomplete="off" method="post" enctype="multipart/form-data"> 
            <input class="carname" name="car_name" placeholder="Autó Neve"/>
            <input class="price" name="price" placeholder="Ár"></textarea>
            <input class="location" name="location" placeholder="Autó helye"></textarea>
            <input class="phonenumber"  name="phone number" placeholder="Telefonszám"></textarea>
            <textarea class="description" name="description"></textarea>
            <input type="file" accept=".png, .jpg, .gif" name="fileToUploadThumb">
            <button type="submit">Gyerönk!</button>
            
        </form>
          
    </body>

</html>
