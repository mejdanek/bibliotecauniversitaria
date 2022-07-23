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
                <p id="p01"> Vi presentiamo la  <strong>"biblioteca universitaria"</strong>.<br>Partendo dai requisiti richiesti, questo progetto è stato sviluppato in linguaggio PHP per la generazione delle pagine, per la connessione al database MySQL e per la gestione della autenticazione utenti.
                La grafica è stata impostata grazie a Bootstrap effettuando delle modifiche personalizzate. Mentre il comportamento delle pagine è stato reso possibile grazie a JQuery; il contenuto dinamico avviene tramite chiamate Ajax
                Il sito è anche predisposto per l'interfacciamento REST.<br><br>
			     Questa applicazione è composta da due aree che sono quella dedicata agli utenti (frontend) e quella dedicata all'amministrazione dei dati del sito (backend). Per entrambe le aree è previsto un accesso con nome utente e password (memorizzati nel database non in chiaro ovvero con pw crittografate).
                 Una volta effettuato l'accesso nell'area utente sarà possibile visualizzare il relativo numero di matricola, il numero di libri in prestito, controllare la lista di libri disponibili nell'archivio con possibilità di prenotazione immediata.
                 Dopodichè è possibile effettuare il cambio di password e indirizzo mail dell'utente loggato.

                 Nell'area di amministrazione è invece possibile verificare la lista di tutti i libri presenti nell'archivio ed eventualmente rimuoverli, inserire un nuovo libro (compreso di tutte le sue caratteristiche) ed infine è possibile effettuare la cancellazione di un utente. 
                 <br> <br>
			
                </p>
            </div>
        </div>
    </main>








    <?php
    include 'common/footer.html';
    ?>