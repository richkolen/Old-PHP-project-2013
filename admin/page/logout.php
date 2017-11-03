<?php
    session_start();

    session_destroy(); //log uit
    header('Location:../../index.php') //ga naar homepage
?>