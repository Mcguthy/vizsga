<?php
// We run Session destroy, in order to logout the user.
session_start();
if(session_destroy()){
    header("Location: /");
}
?>