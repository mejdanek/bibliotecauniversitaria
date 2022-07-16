<?php
//session_start();
$user=$_SESSION["matricola"];
$pwd=$_SESSION["password"];
if(empty($user)){
	header("Location:login.html.php");
    exit;
}
?>
<?php
include 'common/header.html';
?>

    <body>
        <!--Nav Bar-->
        <nav>
            <ul id="menu">
                <li><a href="user-page.php">Home</a></li>
                <li><a class="active" href="user-search-events.html.php">Cerca eventi</a></li>
                <li style="float:right"><a href="user-profile.php">Pagina Utente</a></li>
            </ul>
        </nav>
        <header>
            <br>
            <!--LogoICT-->
            <a href="home.html.php"><img id="left" src="images/logo.png" width="200" alt="logo" title="Logo#CPS/external link"></a>
            <!--Titolo-->
        </header>

        <body>
            <div id="center">
                <h1> Nessun libro trovato!</h1><br><br>
                <form action="user-search-events.html.php" method="post" name="back">
                    <input type="submit" value="Torna indietro e cerca ancora!">
                </form>
            </div>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            <?php
	include 'common/footer.html';
	?>