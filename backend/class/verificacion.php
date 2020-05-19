<?php
    session_start();
    if(!isset($_SESSION["token"]))
        header("Location: ../../frontend/landingPage/index.html");
    
    if(!isset($_COOKIE["token"]))
        header("Location: ../../frontend/landingPage/index.html");

    if($_SESSION["token"] != $_COOKIE["token"])
        header("Location: ../../frontend/landingPage/index.html");

?>