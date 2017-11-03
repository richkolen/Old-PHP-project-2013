<!DOCTYPE html>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/index.css" />
    <meta name="portfolio Nick de Ronde" content="portfolio Nick de Ronde" />
    <meta charset="utf-8" />
    <title>Nick de Ronde</title>
</head>
<body>
    <?php include("includes/header_home.php");?>
    <?php include("includes/navigation_home.php");?>

    <div id="index">
        <h1>My Skills</h1>

        <div class="content">
            <a href="page/dom.php"><img class="image-skill" src="image/skill-dom.png" alt="image skill"></a>
            <h2>DOM-scripting</h2>
            <p>Met de term DOM-scripting wordt </p>
            <p>het programmatisch benaderen</p>
            <p>van het Document Object Model </p>
            <p>bedoeld. Door het implementeren</p>
            <p>van Javascript in het Docume... </p>
            <a href="page/dom.php"><img class="more" alt="button" src="image/more.png" onmouseover="this.src='image/more-hover.png';" onmouseout="this.src='image/more.png'";></a>
        </div>

        <div class="content">
            <a href="page/php.php"><img class="image-skill" src="image/skill-php.png" alt="image skill"></a>
            <h2>PHP5 en SQLi</h2>
            <p>Met Hypertext Preprocessor of ook</p>
            <p>afgekort PHP genoemd, wordt</p>
            <p>content op de website dynamisch</p>
            <p>geladen. Dit gebeurd vaak vanuit</p>
            <p>het beheerders paneel waar...</p>
            <a href="page/php.php"><img class="more" alt="button" src="image/more.png" onmouseover="this.src='image/more-hover.png';" onmouseout="this.src='image/more.png'";></a>
        </div>

        <div class="content">
            <a href="page/design.php"><img class="image-skill" src="image/skill-design.png" alt="image skill"></a>
            <h2>Design UI</h2>
            <p>Met de term UI wordt simpel weg</p>
            <p>de User InterFace bedoeld.</p>
            <p>De UI is wat de gebruiker ziet</p>
            <p>op de website en alles waar op</p>
            <p>gedrukt kan worden door...</p>
            <a href="page/design.php"><img class="more" alt="button" src="image/more.png" onmouseover="this.src='image/more-hover.png';" onmouseout="this.src='image/more.png'";></a>
        </div>
    </div>

    <?php include("includes/footer_home.php");?>
</body>
</html>