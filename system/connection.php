<?php
// These are the parameters of my Database connection.
$server_name="localhost:3306";
$user_name="root";
$password="";
$db_name="car";
//  In "$conn" we make a new mysqli type object, which we will use everytime we want to get data from the database.
$conn=new mysqli($server_name, $user_name, $password, $db_name);
// This row makes sure that our database connection will use the UTF-8 Charachters set, so that foreign latin alphabet letters may be displayed properly.
$conn->set_charset("utf8");
// If by any chance there would be a problem during the database connection, we shut down the connection immidiately and we display the error message.
if($conn->connect_error){
    die("Connect Failed:".$conn->connect_error);
}
?>