<div id="header">
    <form action="../page/search.php" method="get" enctype="multipart/form-data">

        <label for="searchbar"></label>
        <input id="searchbar" type="text" name="searchbar" placeholder="search...">

        <input id="search" type="submit" name="search" value="">
    </form>

    <?php
    session_start();
    if (isset($_SESSION['loggedIn']))  //als de beheerder is ingelogd, laat een image met een link zien
    {
        echo '<a href="../admin/index.php"><img src="../image/login.fw.png" alt="admin_image"></a>';
    }
    ?>

</div>

<div id="header-split"></div>