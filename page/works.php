<?php
require '../admin/includes/connect.php'; //maak connectie met de database
           //selecteer alle onderdelen in de database
$query = "SELECT * FROM project
		  JOIN keyword ON project_id = keyword.project_project_id
		  JOIN media ON project_id = media.project_project_id";

$result = mysqli_query($db, $query);
?>

<!DOCTYPE html>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
    <link rel="stylesheet" type="text/css" href="../css/works.css" />
    <meta name="portfolio Nick de Ronde" content="website Nick de Ronde" />
    <meta charset="utf-8" />
    <title>Nick de Ronde</title>
</head>

<body>
<?php include("../includes/header.php");?>
<?php include("../includes/navigation.php");?>

<div id="content">

    <?php
    while($row = mysqli_fetch_assoc($result)) //zolang er resultaten zijn
    {   //haal de onderdelen uit de database
        $post_id = $row['project_id'];
        $post_link = $row['project_link'];
        $post_date = $row['project_date'];
        $post_author = $row['project_author'];
        $post_title = $row['project_title'];
        $post_content = substr($row['project_content'],0,250);
        $post_image = $row['media_image'];

        ?>

            <a href="project.php?id=<?php echo $post_id; ?>"><img id="project-image" src="../project_image/<?php echo $post_image; ?>" alt="project image"/></a>

            <div id="text">
                <h1><?php echo $post_title; ?></h1>
                <p id="project-content"><?php echo $post_content; ?>.....</p>
                <a href="project.php?id=<?php echo $post_id; ?>"><img id="more" src="../image/more.png" onmouseover="this.src='../image/more-hover.png';" onmouseout="this.src='../image/more.png'";></a>
            </div>
    <?php
    }

    mysqli_close($db); //sluit de database
    ?>

</div>

<?php include("../includes/footer.php");?>
</body>
</html>