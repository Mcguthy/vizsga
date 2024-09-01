<div class="header">
    <?php
    if(isset($_SESSION['login_user'])){
        echo $login_session_username;
        echo "<a href=newCarticle.php>Új Hírdetés</a>";
        echo "<a href=logout.php>Kijelentkezés</a>";
    } else {
        echo "<a target=\"_blank\" href=login.php>Bejelentkezés</a>"; // nem tudom ezt hogy kell összekapcsolni
    }
    
    ?>
    <img src="fejlec.jpg"/>
</div>