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
                <!-- immagine intestazione e titolo-->
                   <img src="images/sfondo2.png"  alt="immagine di intestazione pagina" class="d-block w-100"/> <br><br>
               
              </header>
           
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