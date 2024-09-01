<?php
require("system/session.php");
// we create an empty "error" variable into which we can put an error message which we can echo into the HTML.
$error="";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username=$_POST['username'];
    $password=$_POST['password'];
//here we examine whether or not such an user already exists in our database.
    $userexists_query=$conn->prepare("SELECT count(id) as countid FROM shop_users WHERE username=?");
    $userexists_query->bind_param("s", $username);
    $userexists_query->execute();
    $userexists_result=$userexists_query->get_result();
    $userexists_data=$userexists_result->fetch_assoc();
    //If we found an user matching the inputted username, we try to log in.
    if($userexists_data["countid"]==1){
        $user_query=$conn->prepare("SELECT username, password FROM shop_users WHERE username=?");
        $user_query->bind_param("s", $username);
        $user_query->execute();
        $user_result=$user_query->get_result();
        $user_data=$user_result->fetch_assoc();
        // With the help of the password_verify function, we check if the password inputted matches the password_hash in our database, and if it does we continue the login process.
        if(password_verify($password, $user_data["password"])){
            $_SESSION['login_user']=$username;
            header("Location: /");
        } else{
            $error="hibás felhasználónév vagy jelszó";
        }
    } else{
        $error="Ez a felhasználó nem létezik";
    }
}
?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>Bejelentkezés</title>
        <meta charset="UTF-8">
    </head>
    <body>
    <div class="loginheader">
        <img src="fejlec.jpg"/>
        <p>Üdv a Forza Turismo Használtautók oldalán!<p>
    </div>
    <p><?php echo $error; ?></p>
    <form autocomplete="off" method="post" enctype="multipart/form-data"> 
            <input name="username" placeholder="Felhasználónév">
            <input name="password" type="password" placeholder="Jelszó">
            <button type="submit">Bejelentkezés</button>
    </form>
    </body>
</html>