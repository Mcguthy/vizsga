<?php
require("system/session.php");
if(isset($_SESSION['login_user'])) {
    header("Location: /");
}

$error="";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username=$_POST['username'];
    $password=$_POST['password'];
    $password_hashed=password_hash($password, PASSWORD_DEFAULT);

    $userexists_query=$conn->prepare("SELECT count(id) as countid FROM blog_users WHERE username=?");
    $userexists_query->bind_param("s", $username);
    $userexists_query->execute();
    $userexists_result=$userexists_query->get_result();
    $userexists_data=$userexists_result->fetch_assoc();
    if($userexists_data["countid"]==1){
        $error="Ilyen felhasználó már létezik!";

    } else{
        $user_reg=$conn->prepare("INSERT INTO blog_users (username, password) values (?,?)");
        $user_reg->bind_param("ss", $username, $password_hashed);
        if($user_reg->execute()){
            $error="A regisztráció sikeres";
        } else {
            $error="Hiba történt a regisztráció során";
        }
        
    }
}
?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>Regisztráció</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="loginstyle.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div class="loginheader">
            <img src="fejlec.jpg"/>
            <p>Üdv a Forza Turismo Használtautók oldalán!<p>
        </div>
        <p><?php echo $error; ?></p>
            <div class="Loginbox">        
                <form autocomplete="off" method="post" enctype="multipart/form-data"> 
                        <input class="felnév" name="username" placeholder="Felhasználónév">
                        <input class="jelszo" name="password" type="password" placeholder="Jelszó">
                        <button class="button" type="submit">Regisztrálok!</button>
            </div>
                </form>
        <p class="itwillbefree">A regisztráció ingyenes, és mindig az is marad.</p>
    </body>
</html>