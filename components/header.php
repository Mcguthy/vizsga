<div class="header">
    <?php
    if(isset($_SESSION['login_user'])){
        echo "<a class=\"username\">$login_session_username</a>";
        echo "<a href=newCarticle.php>Új Hírdetés</a>";
        echo "<a href=logout.php>Kijelentkezés</a>";
    } else {
        echo "<a target=\"_blank\" href=login.php>Bejelentkezés</a>"; // nem tudom ezt hogy kell összekapcsolni
    }
    
    ?>
    <img class="Fejleckep" src="fejlec.jpg"/>
</div>