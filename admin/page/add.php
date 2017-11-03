<?php
    require '../includes/connect.php'; //maak connectie met de database
 
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
        <h1>Gebruikersnaam en wachtwoord toevoegen</h1>

            <form method="post" action="add.php">
                <table id="admin-table">
                    <tbody>
                        <tr>
                            <td class="admin-form"><label for="login-name">Gebruikersnaam:</label></td>
                            <td><input id="login-name" type="text" name="login-name"></td>
                        </tr>

                        <tr>
                            <td class="admin-form"><label for="login-password">Wachtwoord:</label></td>
                            <td><input id="login-password" type="text" name="login-password"></td>
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
if(isset($_POST['submit'])) //als de verzend knop is ingedrukt
{
    $admin_name = mysqli_real_escape_string($db, $_POST['login-name']); //post gebruikers in de database
    $admin_pass = mysqli_real_escape_string($db, $_POST['login-password']); //post het wachtwoord in de database

    $encrypt_name = md5($admin_name);   //beveiligd met md5
    $encrypt_pass = md5($admin_pass);   //beveiligd met md5
       //voeg wachtwoord en gebruikersnaam toe
    $insertQuery =  "INSERT INTO admin (admin_id, admin_name, admin_pass)
                     VALUES (NULL, '$encrypt_name', '$encrypt_pass')";

    $result = mysqli_query($db, $insertQuery);


    if($result) //als het toevoegen is geslaagd
    {
        echo "<script>alert('Admin is toegevoegd!')</script>";
        exit();
    }
}

 mysqli_close($db); //sluit database
?>