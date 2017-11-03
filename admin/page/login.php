<?php
require '../includes/connect.php'; // maak connectie met de database
?>

<!DOCTYPE html>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/admin.css" />
    <meta name="portfolio" content="portfolio Nick de Ronde" />
    <meta charset="utf-8" />
    <title>Admin Menu</title>
</head>

<body>
<?php include "../includes/header.php";?>

<div id="admin">
    <div id="login">
        <h1>Admin Login</h1>
            <form method="post" action="login.php">
                <table id="admin-table">
                    <tbody>
                        <tr>
                            <td class="admin-form"><label for="login-name">Gebruikersnaam:</label></td>
                            <td><input id="login-name" type="text" name="login-name"></td>
                        </tr>

                        <tr>
                            <td class="admin-form"><label for="login-password">Wachtwoord:</label></td>
                            <td><input id="login-password" type="password" name="login-password"></td>
                        </tr>
                    </tbody>
                </table>

            <input id="admin-submit" type="submit" name="submit" value="Verzenden">
    </div>
</div>

<?php include "../includes/footer.php";?>
</body>
</html>

<?php
session_start();

    if(isset($_POST['submit'])) //als de verzend is ingedrukt
    {
        $admin_name = mysqli_real_escape_string($db, $_POST['login-name']);     //pak de gebruikersnaam
        $admin_pass = mysqli_real_escape_string($db, $_POST['login-password']); //pak het wachtwoord

        $encrypt_name = md5($admin_name);   //md5 beveiligd
        $encrypt_pass = md5($admin_pass);   //md5 beveiligd
        //selecteer de onderdelen in die gelijk zijn aan de gebruikersnaam en het wachtwoord
        $adminQuery = "SELECT * FROM admin
                       WHERE admin_name = '$encrypt_name' AND admin_pass = '$encrypt_pass'";

        $run = mysqli_query($db, $adminQuery);

        if(mysqli_num_rows($run)>0) // als er onderdelen worden gevonden
        {
            $_SESSION['loggedIn'] = true; // ingelogd

            echo "<script>window.open('../index.php', '_self');</script>";
        }
        else //geen onderdelen worden gevonden
        {
            echo "<script>alert('Uw gebruikersnaam of wachtwoord is onjuist!')</script>"; //foutmelding
        }
    }
mysqli_close($db); //sluit database
?>
