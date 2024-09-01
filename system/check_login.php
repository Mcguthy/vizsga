<?php
// We examine whether or not the user is logged in or not. The "!" in front of the if-clause flips the result around, then it presents the flipped result to the if-clause.
// example if "isset" is true, with "!" it becomes false.
if(!isset($_SESSION['login_user'])){
    header("Location: /");
}
?>