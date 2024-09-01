<?php
require("connection.php");
//with this line of code we start the webpage's session, into which we will load data like usernames.
session_start();
// we examine whether or not the user is logged in, and if the user is logged in, we get the remaining user data from the database based on the username. Remaining data are things like profile pictures for example.
if(isset($_SESSION['login_user'])){
    $username=$_SESSION['login_user'];
    $user_query=$conn->prepare("SELECT username FROM shop_users WHERE username=?");
    $user_query->bind_param("s", $username);
    $user_query->execute();
    $user_result=$user_query->get_result();
    $user_data=$user_result->fetch_assoc();
    $login_session_username=$user_data["username"];
}
?>