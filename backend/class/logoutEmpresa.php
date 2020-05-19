<?php
    session_start();
    session_destroy();
    setcookie("token", "", time()-1, "/");
    setcookie("id", "", time()-1, "/");
    setcookie("latitute", "", time()-1, "/");
    setcookie("longitude", "", time()-1, "/");

    header("Location: ../../frontend/landingPage/index.html");
?>