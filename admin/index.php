<?php
    session_start();

    if (!isset($_SESSION['loggedIn'])) //als de beheerder niet is ingelogd
    {
        header("Location: page/login.php"); //ga naar de login pagina
        exit;
    }
?>

<!DOCTYPE html>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/admin.css" />
    <meta name="description" content="portfolio-website Nick de Ronde" />
    <meta charset="utf-8" />
    <title>Admin Menu</title>
</head>

<body>
    <div id="header"></div>
    <div class="bg-split"></div>

    <div id="frame">
        <?php
        include ("includes/admin_header.php");
        include ("includes/admin_nav_home.php");
        ?>

        <div id="index-content">
            <h1>Dit is het Admin Paneel.</h1>
            <p id="text">Hier kunt U projecten toevoegen, projecten aanpassen en projecten verwijderen.</p>
        </div>

    </div>

    <div class="bg-split"></div>
    <div id="footer"></div>
</body>
</html>