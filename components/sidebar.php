<div class="sidebar">
    <a target="_blank" href="https://x.com/Mcguthy">Twitter</a>
    <a target="_blank" href="https://www.youtube.com/channel/UCIXQCzIVV2WyxCdT0PpxzDA">Youtube</a>
    <a target="_blank" href="https://www.india.gov.in/">Indiai Kormány Weboldala</a>
    <?php
    //This if-clause examines whether or not an user is logged in.
    if(isset($_SESSION['login_user'])) {
        echo "<a href=\"newArticle.php\">Új cikk hozzáadása</a>";
        echo "<a href=\"logout.php\">Kijelentkezés</a>";
    } else {
        echo "<a href=\"login.php\">Bejelentkezés</a>";
        echo "<a href=\"registration.php\">Regisztráció</a>";
    }
    ?>
    <input oninput="passwordchecker()" id="secret_password"/>
    <input oninput="passwordchecker()" id="secret_password2"/>
    <form autocomplete="off" method="post" enctype="multipart/form-data"> 
        <input name="phpassword" placeholder="Vip Access"/>
        <button type="submit">Gyerönk!</button>
    </form>  
</div>