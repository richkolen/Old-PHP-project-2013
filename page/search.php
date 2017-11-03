<!DOCTYPE html>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/works.css" />
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
    <meta name="portfolio Nick de Ronde" content="portfolio Nick de Ronde" />
    <meta charset="utf-8" />
    <title>Nick de Ronde</title>
</head>

<body>
<?php include("../includes/header.php");?>
<?php include("../includes/navigation.php");?>

<div id="content">
    <?php
    require '../admin/includes/connect.php'; //maak connectie met de database

    if(isset($_GET['search'])) //als de zoeknop naast de zoekbalk wordt ingedrukt
    {
        $search_id = $_GET['searchbar']; //pak de waarden die in de zoekbalk zijn ingevuld
        //selecteer alle projecten waar de keywords overeenkomen met de waarden in de zoekbalk
        $searchQuery = "SELECT * FROM project
		                JOIN keyword ON project_id = keyword.project_project_id
		                JOIN media ON project_id = media.project_project_id
		                WHERE keyword_text LIKE '%$search_id%'";

        $resultSearch = mysqli_query($db, $searchQuery);

        while($search_row = mysqli_fetch_assoc($resultSearch)) //zolang er resultaten zijn
        {   //pak de volgende onderdelen uit de database
            $post_id = $search_row['project_id'];
            $post_link = $search_row['project_link'];
            $post_date = $search_row['project_date'];
            $post_author = $search_row['project_author'];
            $post_title = $search_row['project_title'];
            $post_content = substr($search_row['project_content'],0,200); //laat maximaal 200 tekens zien
            $post_image = $search_row['media_image'];

    ?>
            <a href="project.php?id=<?php echo $post_id; ?>"><img id="project-image" src="../project_image/<?php echo $post_image; ?>" alt="project image"/></a>

            <div id="text">
                <h1><?php echo $post_title; ?></h1>
                <p id="project-content"><?php echo $post_content; ?>.....</p>
                <a href="project.php?id=<?php echo $post_id; ?>"><img id="more" src="../image/more.png" onmouseover="this.src='../image/more-hover.png';" onmouseout="this.src='../image/more.png'";></a>
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