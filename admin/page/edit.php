<?php
    require '../includes/functions.php'; //voeg php met functies toe
    require '../includes/connect.php'; //maak connectie met de database

    secure(); //voer functie secure uit
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

    if(isset($_GET['edit'])) //Als de bewerk button is ingedrukt
    {
        $edit_id = $_GET['edit']; //pak het id van het project dat wordt bewerkt
        // selecteer alle onderdelen uit de database die gelijk zijn aan het id van de edit
        $query = "SELECT * FROM project
		          JOIN keyword ON project_id = keyword.project_project_id
		          JOIN media ON project_id = media.project_project_id
		          WHERE project_id = '$edit_id'";

        $result = mysqli_query($db, $query);

        while($row = mysqli_fetch_assoc($result)) //zolang er resultaten zijn
        {
            $post_id = $row['project_id'];
            $post_link = $row['project_link'];
            $post_keyword = $row['keyword_text'];
            $post_author = $row['project_author'];
            $post_title = $row['project_title'];
            $post_content = $row['project_content'];
            $post_image = $row['media_image'];
?>

    <div id="input-form">
        <h1>Add new project</h1>

            <form method="post" action="edit.php?edit_form=<?php echo $edit_id;?>" enctype="multipart/form-data">
                <table>
                    <tbody>
                        <tr>
                            <td class="form-text"><label for="author">Auteur:</label></td>
                            <td><input id="author" type="text" name="author" value="<?php echo $post_author;?>"></td>
                        </tr>

                        <tr>
                            <td class="form-text"><label for="link">Link:</label></td>
                            <td><input id="link" type="text" name="link" value="<?php echo $post_link;?>"> (optioneel)</td>
                        </tr>

                        <tr>
                            <td class="form-text"><label for="keywords">Keywords:</label></td>
                            <td><input id="keywords" type="text" name="keywords" value="<?php echo $post_keyword;?>"></td>
                        </tr>

                        <tr>
                            <td class="form-text"><label for="title">Titel:</label></td>
                            <td><input id="title" type="text" name="title" value="<?php echo $post_title;?>"></td>
                        </tr>

                        <tr>
                            <td class="form-text"><label for="image">Foto:</label></td>
                            <td><input id="image" type="file" name="image"><img id="edit-image" src="../../project_image/<?php echo $post_image;?>" alt="project foto"/></td>
                        </tr>

                        <tr>
                            <td class="form-text"><label for="content">Content:</label></td>
                            <td><textarea id="content" name="content"><?php echo $post_content;?></textarea></td>
                        </tr>
                    </tbody>
                </table>
<?php
        }
    }
?>
                <input id="submit" type="submit" name="submit" value="Post bijwerken">
            </form>
    </div>
</div>

<?php include "../includes/footer.php";?>
</body>
</html>

<?php
if(isset($_POST['submit'])) //als de verzend knop is ingedrukt
{   //pak de waarden uit de velden in het formulier
    $update_id = $_GET['edit_form'];
    $post_new_date = date('d-m-y');
    $post_new_link = $_POST['link'];
    $post_new_author = $_POST['author'];
    $post_new_title = $_POST['title'];
    $post_new_keyword = $_POST['keywords'];
    $post_new_content = $_POST['content'];
    $post_new_image = $_FILES['image']['name'];
    $image_temp = $_FILES['image']['tmp_name'];

    if(empty($post_new_author) || empty($post_new_keyword) || empty($post_new_title) || empty($post_new_content)) //als er velden leeg zijn
    {
        echo "<script>alert('U heeft één van de velden niet ingevuld!'); history.back(); </script>"; //foutmelding
        exit();
    }
    else //als de velden zijn ingevuld
    {
        if(!empty($post_new_image)) //er wordt een nieuwe foto gekozen voor het project
        {
            $imageQuery = "SELECT * FROM media WHERE project_project_id = '$update_id'";

            $imageResult = mysqli_query($db, $imageQuery);

                while($row = mysqli_fetch_assoc($imageResult)) //zolang er resultaten zijn
                {
                    $post_image = $row['media_image'];
                    $path = "../../project_image";

                    if(file_exists($path."/".$post_image)) //de foto bestaat nog in de map
                    {
                        unlink($path."/".$post_image); //verwijder de foto
                    }
                }

            move_uploaded_file($image_temp, "../../project_image/$post_new_image"); // plaats de foto in de map
            // pas de gewijzigde velden aan
            $updateImageQuery = "UPDATE project
                        JOIN keyword ON project_id = keyword.project_project_id
                        JOIN media ON project_id = media.project_project_id
                        SET project_author = '$post_new_author', project_link = '$post_new_link', media_image = '$post_new_image', keyword_text = '$post_new_keyword',
                        project_title = '$post_new_title', project_content = '$post_new_content', project_date = '$post_new_date'
                        WHERE project_id = '$update_id'";

            $imageResult = mysqli_query($db, $updateImageQuery);

            if($imageResult) //als het aanpassen is geslaagd
            {
                echo "<script>alert('Het project is bijgewerkt!')</script>";
                echo "<script>window.open('all_posts.php', '_self');</script>";
            }
        }
        else //als er geen nieuwe foto wordt geplaatst
        { //pas de overige gewijzigde velden aan
        $updateQuery = "UPDATE project
                        JOIN keyword ON project_id = keyword.project_project_id
                        SET project_author = '$post_new_author', project_link = '$post_new_link', keyword_text = '$post_new_keyword',
                        project_title = '$post_new_title', project_content = '$post_new_content', project_date = '$post_new_date'
                        WHERE project_id = '$update_id'";

        $result = mysqli_query($db, $updateQuery);

            if($result) //als het aanpassen is geslaagd
            {
                echo "<script>alert('Het project is bijgewerkt!')</script>";
                echo "<script>window.open('all_posts.php', '_self');</script>";
            }
        }
    }

    mysqli_close($db); //sluit database
}
?>
