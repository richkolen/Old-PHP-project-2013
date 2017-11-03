<?php
    require '../includes/functions.php'; //voeg php met functies toe

    secure();  //voer functie secure uit
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

    <div id="frame">
        <?php
            include ("../includes/admin_header.php");
            include ("../includes/admin_nav.php");
        ?>

        <div id="input-form">
            <h1>Voeg een nieuw project toe</h1>

                <form method="post" action="insert_post.php" enctype="multipart/form-data">
                    <table>
                        <tbody>
                            <tr>
                                <td class="form-text"><label for="author">Auteur:</label></td>
                                <td><input id="author" type="text" name="author"></td>
                            </tr>

                            <tr>
                                <td class="form-text"><label for="link">Link:</label></td>
                                <td><input id="link" type="text" name="link"> (optioneel)</td>
                            </tr>

                            <tr>
                                <td class="form-text"><label for="keywords">Keywords:</label></td>
                                <td><input id="keywords" type="text" name="keywords"></td>
                            </tr>

                            <tr>
                                <td class="form-text"><label for="title">Titel:</label></td>
                                <td><input id="title" type="text" name="title"></td>
                            </tr>

                            <tr>
                                <td class="form-text"><label for="image">Foto:</label></td>
                                <td><input id="image" type="file" name="image"></td>
                            </tr>

                            <tr>
                                <td class="form-text"><label for="content">Content:</label></td>
                                <td><textarea id="content" name="content"></textarea></td>
                            </tr>
                        </tbody>
                    </table>
                        <input id="submit" type="submit" name="submit" value="Post toevoegen">
                </form>
        </div>
    </div>

    <?php include "../includes/footer.php";?>
</body>
</html>


<?php
require '../includes/connect.php';

if(isset($_POST['submit'])) //als de verzendknop is ingedrukt
{   //pak de volgende onderdelen uit het formulier
    $post_date = date('d-m-y');
    $post_link = $_POST['link'];
    $post_author = $_POST['author'];
    $post_title = $_POST['title'];
    $post_keyword = $_POST['keywords'];
    $post_content = $_POST['content'];
    $post_image = $_FILES['image']['name'];
    $image_temp = $_FILES['image']['tmp_name'];

    //als er velden leeg zijn
    if(empty($post_author) || empty($post_keyword) || empty($post_title) || empty($post_content) || empty($post_image))
    {
        echo "<script>alert('U heeft één van de velden niet ingevuld!'); history.back(); </script>"; //foutmelding
        exit();
    }
    else //als de velden zijn ingevuld
    {
        move_uploaded_file($image_temp, "../../project_image/$post_image");
        mysqli_autocommit($db, FALSE); //zet veilig toevoegen uit
        //voeg onderdelen in de database toe
        $insertQuery =
        "INSERT INTO project (project_id, project_date, project_title,  project_content, project_author, project_link)
         VALUES (NULL, '$post_date', '$post_title', '$post_content', '$post_author', '$post_link');
         INSERT INTO keyword (keyword_id, keyword_text, project_project_id)
         VALUES(NULL,'$post_keyword', LAST_INSERT_ID());
         INSERT INTO media (media_id, media_image, project_project_id)
         VALUES(NULL,'$post_image', LAST_INSERT_ID());
         COMMIT";

        mysqli_autocommit($db, TRUE); //zet veilig toevoegen aan
        $result = mysqli_multi_query($db, $insertQuery); //voer meervoudige query uit

        if($result) //als het toevoegen is gelukt
        {
            echo "<script>alert('Het project is toegevoegd!')</script>";
            exit();
        }
    }

    mysqli_close($db); // sluit database
}
?>