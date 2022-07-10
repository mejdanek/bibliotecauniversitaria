<?php
include 'common/header.html';
?>

<body>
    <!--Barra di navigazione-->
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
        <div class="container">
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.html.php">Area utenti</a>
                    </li>
                    <li class="nav-item"><a></a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin-login.html.php">Area admin</a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>

    <main role="main" class="container">
        <div class="jumbotron">
            <header>
                <!--LogoICT-->
                <a href="index.php"><img id="left" src="images/logo.png" width="200" alt="logo" title="Logo#CPS/external link"></a>
                <!--Titolo-->
                <h1>Biblioteca universitaria: cultura e studio per tutti gli studenti</h1><br><br><br>
            </header>
            <!--Immagine Torino-->
            <div id="center"><br><br>
            </div>
            <div id="main">
                <!--Inizio contenuto della pagina-->
                <p id="p01"> Vi presentiamo la  <strong>"biblioteca universitaria"</strong>?<br>La Biblioteca Universitaria offre un servizio per tutti gli studenti dell'Università di Torino che hanno 
            bisogno di reperire testi, materiale per la preparazione dei loro esami oppure della loro tesi.<br><br>
			Quello che ci contraddistingue è la passione per i libri e prenderci cura di loro. Il nostro obiettivo
            è quello di offrire un servizio che possa soddisfare tutti gli studenti ed inoltre metteremo a disposizione
            le aree comuni per far si che tutti i ragazzi possano studiare direttamente nella biblioteca con i loro compagni di corso.
            Gli studenti potranno così incrementare le loro sfera della conoscenza, socializzazione, informazione e divertimento.
            Per conoscere <b>opportunità </b>, <b>agevolazioni</b> e le <b>offerte rivolte agli studenti</b> di Torino
            è possibile visitare il nostro sito: <a href="https://www.unito.it/ateneo/strutture-e-sedi/strutture/biblioteche" title="external link" target="_blank">"Biblioteca Universitaria"</a>. <br> <br>
			
                </p>
            </div>
        </div>
    </main>








    <?php
    include 'common/footer.html';
    ?>