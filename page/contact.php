<!DOCTYPE html>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
    <link rel="stylesheet" type="text/css" href="../css/contact.css" />
    <meta name="portfolio Nick de Ronde" content="portfolio Nick de Ronde" />
    <meta charset="utf-8" />
    <title>Nick de Ronde</title>
</head>

<body>
<?php include("../includes/header.php");?>
<?php include("../includes/navigation.php");?>

<div id="my-info">
    <div id="address">
        <h2>My Address</h2>
        <img id="map" src="../image/map.png" alt="googlemap">
        <p>Wijnhaven 107</p>
        <p id="info">3011 WN Rotterdam</p>
        <p>Tel: 010-7948000</p>
        <p>Email: nick@deronde.nl</p>
    </div>

    <div id="contact-form">
        <h2>Contact</h2>

        <form method="post" action="contact.php">
            <table>
                <tbody>
                <tr>
                    <td class="form-label"><label for="fullname">Naam</label></td>
                    <td class="form-input"><input id="fullname" type="text" name="fullname"></td>
                </tr>

                <tr>
                    <td class="form-label"><label for="email">Email</label></td>
                    <td class="form-input"><input id="email" type="email" name="email"></td>
                </tr>

                <tr>
                    <td class="form-label"><label for="number">Tel</label></td>
                    <td class="form-input"><input id="number" type="text" name="number"></td>
                </tr>

                <tr>
                    <td id="form-label"><label for="message">Bericht</label></td>
                    <td class="form-input"><textarea id="message" spellcheck="false" name="message"></textarea></td>
                </tr>
                </tbody>
            </table>
            <input id="send" type="submit" name="submit" value="Verstuur">
        </form>
    </div>
</div>

<?php include("../includes/footer.php");?>
</body>
</html>

<?php
//Als de verzendknop is ingedrukt
if(isset($_POST['submit']))
{
    $name = $_POST['fullname'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $message = $_POST['message'];
    $to = "richardkolen@gmail.com";
    $subject = "Nieuw bericht van ".$name."!";

    if(empty($name) || empty($email) || empty($number) || empty($message)) //Als alle velden leeg zijn geef een foutmelding
    {
        echo "<script>alert('U heeft één van de velden niet ingevuld!'); history.back(); </script>";
        exit();
    }
    else //Als alle velden zijn ingevuld verzend de email
    {
        mail($to, $subject, "Van: ".$email."  - - - - - -  Tel: ".$number. " - - - - - - Bericht: " .$message ,'From:'.$to);


        echo "<script>alert('U bericht is verzonden!')</script>";
        echo "<script>window.open('contact.php', '_self');</script>";
        exit();
    }
}
?>
