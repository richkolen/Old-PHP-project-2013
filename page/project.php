<?php
    require '../admin/includes/connect.php'; //maak connectie met de database

    if(isset($_GET['id'])) //pak het meegestuurde id van het project die op works.php werd aangeklikt
    {
        $project_id = $_GET['id'];
    //selecteer van alle projecten waar het id gelijk is aan het meegestuurde id
    $selectQuery = "SELECT * FROM project
		            JOIN keyword ON project_id = keyword.project_project_id
		            JOIN media ON project_id = media.project_project_id
		            WHERE project_id = '$project_id'";

    $resultProject = mysqli_query($db, $selectQuery);
?>

<!DOCTYPE html>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/project.css" />
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
    <meta name="portfolio Nick de Ronde" content="portfolio Nick de Ronde" />
    <meta charset="utf-8" />
    <title>Nick de Ronde</title>
</head>

<body>
    <?php include("../includes/header.php");?>
    <?php include("../includes/navigation.php");?>

    <div id="project">
        <?php
        while($row = mysqli_fetch_assoc($resultProject)) //zolang er resultaten zijn
        {   //pak de volgende onderdelen uit de database
            $post_link = $row['project_link'];
            $post_date = $row['project_date'];
            $post_author = $row['project_author'];
            $post_title = $row['project_title'];
            $post_content = $row['project_content'];
            $post_image = $row['media_image'];
        ?>
            <p id="info"><strong>Gepost door</strong> <?php echo $post_author; ?> <strong>op</strong> <?php echo $post_date; ?></p>
            <h1><?php echo $post_title; ?></h1>
            <a href= "<?php echo $post_link; ?>" target="_blank"><img id="project-image" src="../project_image/<?php echo $post_image; ?> " alt="project image"/></a>

            <div id="content">
            <p id="project-content"><?php echo $post_content; ?></p>
            </div>
    <?php
        }
    }

    mysqli_close($db); //sluit de database
    ?>

    </div>

    <?php include("../includes/footer.php");?>
</body>
</html>