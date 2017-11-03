<?php
    require '../includes/functions.php'; //voeg php met functies toe
    require '../includes/connect.php'; //maak connectie met de database

    secure(); //voer functie secure uit
    // selecteer alle onderdelen uit de database
    $query = "SELECT * FROM project
		      JOIN keyword ON project_id = keyword.project_project_id
		      JOIN media ON project_id = media.project_project_id";

    $result = mysqli_query($db, $query);
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

    <div id="projects">
        <h1>View all projects</h1>
            <table id="show">
                <thead>
                    <tr>
                        <th id="head-id">ID</th>
                        <th>Auteur</th>
                        <th>Datum</th>
                        <th>Keywords</th>
                        <th>Link</th>
                        <th>Titel</th>
                        <th>Foto</th>
                        <th>Content</th>
                        <th>Bewerk</th>
                        <th>Verwijder</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <?php
                        while($row = mysqli_fetch_assoc($result)) //zolang er resultaten zijn
                        {   //pak de volgende onderdelen uit de database
                            $post_id = $row['project_id'];
                            $post_keywords = $row['keyword_text'];
                            $post_link = $row['project_link'];
                            $post_date = $row['project_date'];
                            $post_author = $row['project_author'];
                            $post_title = $row['project_title'];
                            $post_content = substr($row['project_content'],0,50);
                            $post_image = $row['media_image'];

                        ?>

                        <td id="table-id"><?php echo $post_id; ?></td>
                        <td class="table-content"><?php echo $post_author; ?></td>
                        <td class="table-content"><?php echo $post_date; ?></td>
                        <td class="table-content"><?php echo $post_keywords; ?></td>
                        <td class="table-content"><?php echo $post_link; ?></td>
                        <td class="table-content"><?php echo $post_title; ?></td>
                        <td class="table-content" ><img id="show-image" src="../../project_image/<?php echo $post_image; ?>" alt="project image"/></td>
                        <td id="content-table"><?php echo $post_content; ?></td>
                        <td class="table-content"><a href="edit.php?edit=<?php echo $post_id; ?>"><img src="../../image/edit.gif" alt="edit-button"></a></td>
                        <td class="table-content"><a href="delete.php?del=<?php echo $post_id; ?>"><img src="../../image/delete.gif" alt="delete-button"></a></td>
                    </tr>
                </tbody>
<?php
                        }

mysqli_close($db); //sluit database
?>
            </table>
    </div>
</div>

<?php include "../includes/footer.php";?>
</body>
</html>