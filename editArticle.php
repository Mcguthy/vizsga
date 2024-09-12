<?php 
require("system/session.php");
// with the function in this file we examine whether or not the user is logged in.
require("system/check_login.php");

//Here we grab the data after "id=" from the link
$getlinkid=htmlspecialchars($_GET["id"]);
$article_query=$conn->prepare("SELECT car_name, price, location, phone_number, description, picture FROM car_articles WHERE id=?");
$article_query->bind_param("i", $getlinkid);
$article_query->execute();
$article_result=$article_query->get_result();
$article_data=$article_result->fetch_assoc();

if($_SERVER["REQUEST_METHOD"]=="POST") {
    //we want matching id's to the article cover picture, so we get the latest id from the DB and adding +1 to it
    $row_id=$article_data["id"];
    //we are storing all article covers in one folder
    //any other pictures in the articles are stored separately in the user's directory
    $target_dir = "img/";

    //uploading a picture is not required, so we are checking here is there's an image present at the upload or not
    if ($_FILES["fileToUploadThumb"]["name"] == NULL) {
        $sqlfilename = $article_data["picture"];
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
    //With the help of $_POST we grab the data from the HTML-Forms with the help of nametags (ex: name="title")
    $form_carname=$_POST['car_name'];
    $form_price=$_POST['price'];
    $form_location=$_POST['location'];
    $form_phonenumber=$_POST['phone_number'];
    $form_description=$_POST['description'];
    $form_picture=$sqlfilename;
    $sql_read=$conn->prepare("UPDATE car_articles SET car_name=?, price=?, location=?, phone_number=?, description=?, picture=? WHERE id=?");
    $sql_read->bind_param("ssssssi", $form_carname, $form_price, $form_location, $form_phonenumber, $form_description, $form_picture, $getlinkid);
    // Here we ran our SQL code if it was successful we redirect the user to the front page, if not we echo the error message
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
        <title>Cikk Szerkesztése</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

    </head>

    <body>
        <?php
        require("components/header.php");
        ?>
        <form autocomplete="off" method="post" enctype="multipart/form-data"> 
            <input name="car_name" placeholder="Autó Neve" value="<?php echo $article_data["car_name"]; ?>"/>
            <input name="price" placeholder="Autó Ára"> <?php echo $article_data["price"]; ?></input>
            <input name="location" placeholder="Autó Helye"> <?php echo $article_data["location"]; ?></input>
            <input name="phone_number" placeholder="Telefonszám"><?php echo $article_data["phone_number"]; ?></input>
            <textarea name="description"><?php echo $article_data["description"]; ?></textarea>
            <input type="file" accept=".png, .jpg, .gif" name="fileToUploadThumb">
            <img style="width: 200px; height: auto;" src="<?php echo $article_data["picture"]; ?>">
            <button type="submit">Cikk Frissitése</button>
            
        </form>
          
    </body>

</html>