<?php

function secure()
{
    session_start();

    if (!isset($_SESSION['loggedIn'])) //als de beheerder niet is ingelogd
    {
        header("Location: login.php"); //ga naar login page
        exit;
    }
}

?>