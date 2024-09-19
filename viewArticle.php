<?php 
require("system/session.php");
$getlinkid=htmlspecialchars($_GET["id"]);
$sql_read=$conn->prepare("SELECT * FROM car_articles WHERE id=?");
$sql_read->bind_param("i", $getlinkid);
$sql_read->execute();
$data_from_sql=$sql_read->get_result();
$article_data=$data_from_sql->fetch_assoc();

?>

<!DOCTYPE HTML>
<html> 
    <head>
        <title><?php echo $article_data["car_name"] ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="carticle.css">

    </head>
    <body>
        <div class="main">

        <?php
        require("components/header.php");
        ?>
        <div class="split-container">
            <div class="main-container">
                    <div class="article-container">
                        <?php     
                           echo "<div class=\"picture-box\">";       
                                echo "<img src=\"".$article_data["picture"]."\" class=\"article-picture\"/>";
                           echo "</div>" ;     
                           echo "<div class=\"article\">";
                                echo "<h2 class=\"car-name\">".$article_data["car_name"]."</h2>";
                                echo "<p class=\"price\">".$article_data["price"]."</p>";
                                echo "<a class=\"location\">".$article_data["location"]."/</a>";
                                echo "<a class=\"phone_number\">".$article_data["phone_number"]."</a>";
                                echo "<p class=\"description\">".$article_data["description"]."</p>";
                            echo "</div>";
                        ?>    
                    </div>
                    <?php
                     if(isset($_SESSION['login_user'])) { 
                        echo "<a class=\"edit\" href=\"editArticle.php?id=".$article_data["id"]."\">Szerkesztés</a>";
                     }
                    ?>
            </div>
        </div>
        <?php
        require("components/footer.php");
        ?>
    </div>
    </body>
</html>
