<?php
    require '../includes/functions.php'; //voeg php met functies toe

    secure(); //voer functie secure uit


if(isset($_GET['del']))  //als de delete button wordt ingedrukt
{
    require '../includes/connect.php'; // maak connectie met de database

    $delete_id = $_GET['del']; //pak het id dat wordt meegestuurd in de variabale del

    $query = "SELECT * FROM media WHERE project_project_id = '$delete_id'"; //selecteer alle media gelijk aan het id van de delete

    $result = mysqli_query($db, $query);

        while($row = mysqli_fetch_assoc($result)) //zolang er resultaten zijn
        {
            $post_image = $row['media_image'];
            $path = "../../project_image";

            if(file_exists($path."/".$post_image)) //Als de foto bestaat in de map
            {
                unlink($path."/".$post_image); //verwijder de foto uit de map
            }
        }

    //verwijder alle onderdelen uit de database, waar het id gelijk is aan het id van de delete
    $deleteQuery = "DELETE project, media, keyword FROM project
		            JOIN keyword ON project_id = keyword.project_project_id
		            JOIN media ON project_id = media.project_project_id
		            WHERE project_id = $delete_id";

    if(mysqli_query($db, $deleteQuery)) //als het verwijderen is geslaagd
    {
        echo "<script>alert('Het project is verwijderd!')</script>";
        echo "<script>window.open('all_posts.php', '_self');</script>";
    }

    mysqli_close($db); //sluit database
}
?>




