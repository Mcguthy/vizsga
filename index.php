<?php 
require("system/session.php");
// Here we present all the articles from out database on our front page.
$sql_read=$conn->prepare("SELECT * FROM car_articles ORDER BY Id DESC");
$sql_read->execute();
$data_from_sql=$sql_read->get_result();
?>

<!DOCTYPE HTML>
<html> 
    <head>
        <title>Forza Turismo Használtautók</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">

    </head>
    <body>
        <div class="main">

        <?php
        // To avoid unneccesary repeating of code, we made each of the minor components into their own .php file, so that we may use them later repeatedly
        require("components/header.php");
        ?>
            <div class="main-container">
                    <div class="Article-container">
                        
                        <?php
                        // Here we present every article from our database with the help of a while-cycle. 
                        while($result=$data_from_sql->fetch_assoc()){
                            // The fetch_assoc function grabs and puts every article into the $results variable in the order in which they were created.
                            echo "<div class=\"Car-container\">";
                                echo "<div class=\"picture-box\">";
                                    echo "<img src=\"".$result["picture"]."\" class=\"car-picture\"/>";
                                echo "</div>";
                                echo "<div class=\"article\">";    
                                    echo "<a href=\"viewArticle.php?id=".$result["id"]."\" class=\"car_name\">".$result["car_name"]."</a>";
                                    echo "<p class=\"price\">".$result["price"]."</p>";
                                    echo "<a class=\"location\">".$result["location"]."/</a>";
                                    echo "<a class=\"phonenumber\">".$result["phone_number"]."</a>";
                                    echo "<p class=\"car-description\">".$result["description"]."</p>";
                                echo "</div>";
                            echo "</div>";
                        }
                        ?>    
                    </div>
            </div>
        </div>
        <?php
        require("components/footer.php");
        ?>  
    </body>
</html>
