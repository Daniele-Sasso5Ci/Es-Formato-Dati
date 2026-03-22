# Es-Formato-Dati
Il progetto è stato realizzato con l’obiettivo di integrare i quattro linguaggi di programmazione studiati durante il corso all’interno di un’unica applicazione. Lo sviluppo ha previsto la progettazione di una struttura chiara e organizzata, in cui ogni linguaggio svolge un ruolo specifico, contribuendo al funzionamento complessivo del programma.

Per la gestione del codice è stata utilizzata una repository su GitHub, che ha permesso di mantenere il progetto ordinato e di tracciare le diverse modifiche effettuate nel tempo.

L’obiettivo principale dell’esercitazione è stato quello di applicare in modo concreto le conoscenze acquisite durante le lezioni, mettendo in relazione diversi linguaggi di programmazione. In particolare, il lavoro ha permesso di comprendere come strutturare un progetto completo, organizzare il codice in modo leggibile e funzionale e utilizzare strumenti di versionamento come GitHub.

Il file index.html rappresenta la pagina iniziale del progetto e costituisce il primo punto di accesso per l’utente. Al suo interno vengono definiti sia la struttura della pagina tramite HTML sia lo stile grafico attraverso l’utilizzo del CSS incorporato.

La pagina è progettata per offrire un’interfaccia semplice e intuitiva. Viene utilizzata un’immagine di sfondo per migliorare l’aspetto visivo, mentre al centro della schermata è presente un contenitore che include un messaggio di benvenuto e le principali opzioni disponibili per l’utente.

All’interno di questo contenitore sono presenti due collegamenti: uno che consente la registrazione di un nuovo utente tramite il file register.php e uno che permette l’accesso al sistema tramite il file login.php. In questo modo, la pagina funge da punto di collegamento tra l’interfaccia iniziale e le funzionalità dinamiche del progetto.

Dal punto di vista grafico, il layout è stato realizzato utilizzando il sistema Flexbox, che permette di gestire l’allineamento degli elementi in modo flessibile e preciso. Il contenitore principale è centrato nella pagina tramite posizionamento assoluto e trasformazioni CSS, mentre è stato applicato un effetto di sfocatura per migliorare la leggibilità del contenuto rispetto allo sfondo.

Inoltre, è stato utilizzato un font personalizzato importato da Google Fonts, con l’obiettivo di rendere l’interfaccia più curata e uniforme.

Nel complesso, questo file ha il compito di introdurre l’utente al sistema e di indirizzarlo verso le principali funzionalità disponibili.

Il file login.php ha il compito di gestire l’autenticazione degli utenti, ovvero di controllare che solo chi è registrato possa accedere alle pagine protette del progetto. Si tratta quindi di un punto cruciale, perché garantisce la sicurezza e l’integrità dei dati.

All’inizio del file viene incluso config.php, che contiene la configurazione per la connessione al database. Questo passaggio è fondamentale: senza la connessione al database non sarebbe possibile verificare le credenziali inserite dall’utente.

Il codice controlla poi il metodo della richiesta HTTP tramite $_SERVER["REQUEST_METHOD"]. Se la richiesta è di tipo POST, significa che l’utente ha inviato il form di login. In quel caso il programma recupera i dati inseriti nei campi username e password.

A questo punto viene preparata una query SQL utilizzando prepare per cercare l’utente nel database. L’utilizzo di prepare e bind_param è importante per prevenire attacchi di tipo SQL injection, evitando che input malevoli possano compromettere il database. La query cerca nella tabella utenti un record con lo username corrispondente e, se trovato, recupera l’ID dell’utente e la password memorizzata.

Successivamente, il codice verifica se l’utente esiste controllando il numero di righe restituite dalla query. Se l’utente non è presente, viene visualizzato un messaggio di errore specifico. Se invece l’utente esiste, il programma confronta la password inserita con quella memorizzata usando la funzione password_verify. Questo passaggio è fondamentale perché il database non conserva la password in chiaro, ma una versione crittografata: password_verify permette di verificare correttamente la corrispondenza senza esporre le password.

Se la password è corretta, il programma salva i dati dell’utente nella sessione ($_SESSION["user_id"] e $_SESSION["username"]) e reindirizza l’utente alla pagina dashboard.php. Questo passaggio permette di mantenere lo stato di login tra le diverse pagine del sito. Se la password è errata, invece, viene mostrato un messaggio di errore ben visibile tramite un div rosso nella parte superiore della pagina.

Dal punto di vista dell’interfaccia grafica, il form è posizionato al centro dello schermo, all’interno di un contenitore con effetto di sfocatura per migliorare la leggibilità. I campi sono obbligatori (required) e la funzione autocomplete="off" viene utilizzata per motivi di sicurezza, evitando che il browser memorizzi le credenziali inserite. I pulsanti e i collegamenti sono chiaramente visibili e permettono all’utente di tornare alla pagina principale (index.html) se desidera interrompere il login.

In sintesi, login.php svolge diverse funzioni fondamentali: connessione al database, protezione contro attacchi esterni, verifica delle credenziali, gestione della sessione e presentazione di un’interfaccia chiara e sicura. Ogni passaggio è stato progettato con attenzione per garantire sia la funzionalità sia la sicurezza dell’applicazione, rendendo questa pagina uno dei componenti principali del progetto.

Il file config.php è fondamentale per tutto il progetto, perché contiene la configurazione necessaria per connettersi al database dove sono memorizzati gli utenti e altri dati del registro elettronico.

All’inizio viene avviata la sessione PHP con session_start(), in modo da poter gestire login, logout e mantenere le informazioni dell’utente durante la navigazione tra le pagine. Senza questo passaggio, non sarebbe possibile salvare in modo persistente le informazioni dell’utente dopo il login.

Successivamente vengono definiti i parametri di connessione al database: host, user, pass e db. Questi valori permettono al server di sapere a quale database connettersi e con quali credenziali.

La connessione effettiva viene effettuata tramite l’oggetto mysqli. Se la connessione va a buon fine, tutte le pagine che includono questo file possono eseguire query sul database senza dover riscrivere ogni volta i dettagli della connessione. Se invece la connessione fallisce, il programma termina l’esecuzione mostrando un messaggio di errore chiaro, così da sapere immediatamente cosa non funziona.

In sintesi, config.php centralizza la gestione del database e della sessione, rendendo il codice più ordinato, modulare e sicuro. Tutti gli altri file PHP del progetto, come login.php o register.php, includono questo file per poter interagire con il database in modo semplice e coerente.

Il file register.php gestisce il processo di registrazione degli utenti all’interno del sistema. A differenza del login, questa pagina non si limita a verificare dati esistenti, ma si occupa di validare le informazioni inserite e salvarle correttamente nel database, garantendo allo stesso tempo coerenza e sicurezza.

All’inizio del file viene incluso config.php, che permette di stabilire la connessione al database e di gestire le sessioni. Questo è necessario perché la registrazione comporta l’inserimento di nuovi dati nella tabella degli utenti.

Quando l’utente invia il form tramite metodo POST, il programma recupera il valore dell’ID inserito. Questo ID non viene accettato direttamente, ma viene prima verificato attraverso un controllo esterno basato su file JSON e XML. In particolare, il file registro.json viene letto tramite la funzione file_get_contents e convertito in una struttura dati utilizzabile in PHP con json_decode. Da questo file viene estratto il percorso di un file XML contenente i dati degli studenti.

Il file XML viene quindi caricato utilizzando la classe DOMDocument. Prima di essere utilizzato, viene verificato che esista effettivamente nel percorso indicato; in caso contrario, l’esecuzione viene interrotta per evitare errori. Successivamente, il documento XML viene validato per assicurarsi che rispetti la struttura prevista (definita dal DTD). Questo passaggio è importante perché garantisce che i dati siano corretti e leggibili.

Per interrogare il contenuto del file XML viene utilizzato DOMXPath, che permette di eseguire query strutturate. In questo caso viene costruita una query che seleziona un elemento alunno in base all’ID inserito. Se il nodo viene trovato e l’ID ha una lunghezza valida (pari a 5 caratteri), significa che l’utente è effettivamente presente nel registro e può quindi essere registrato nel sistema.

A questo punto vengono recuperati anche username e password inseriti dall’utente. La password non viene salvata in chiaro, ma viene trasformata in una versione crittografata tramite la funzione password_hash, che aumenta significativamente la sicurezza del sistema.

Il programma prepara quindi una query SQL per inserire i dati nella tabella utenti. Anche in questo caso viene utilizzato prepare con bind_param, così da prevenire attacchi SQL injection. Se l’inserimento va a buon fine, viene mostrato un messaggio di conferma.

Nel caso in cui si verifichi un errore, il codice controlla se si tratta di un duplicato (ad esempio ID o username già presenti). Questo viene fatto analizzando il codice di errore restituito dal database. In base al tipo di errore, viene mostrato un messaggio specifico, rendendo il sistema più chiaro e user-friendly. Se invece l’ID non è valido o non è presente nel file XML, viene mostrato un messaggio di errore che impedisce la registrazione.

Dal punto di vista grafico, la pagina mantiene uno stile coerente con le altre, utilizzando un contenitore centrale e mostrando eventuali messaggi di errore o successo nella parte superiore della schermata. Il form richiede tutti i dati necessari e impedisce l’invio di campi vuoti grazie all’attributo required.

In conclusione, register.php rappresenta una delle parti più complesse del progetto, in quanto integra diverse tecnologie: lettura di file JSON, elaborazione di dati XML, validazione tramite DTD e interazione con il database. Questo approccio garantisce che solo utenti validi possano registrarsi e che i dati inseriti siano corretti, migliorando sia la sicurezza sia l’affidabilità del sistema.

Il file dashboard.php rappresenta l’area riservata del sistema, accessibile solo agli utenti autenticati. Il suo scopo principale è quello di mostrare i dati personali dell’utente e il registro dei voti, recuperandoli da un file XML strutturato.

All’inizio del file viene incluso config.php, necessario per la gestione della sessione e per eventuali operazioni legate al database. Subito dopo viene effettuato un controllo sulla sessione: se la variabile $_SESSION["user_id"] non è impostata, significa che l’utente non ha effettuato il login. In questo caso, il sistema reindirizza automaticamente alla pagina login.php, impedendo l’accesso non autorizzato. Questo passaggio è fondamentale per garantire la sicurezza dell’applicazione.

Successivamente, il programma legge il file registro.json utilizzando file_get_contents e lo converte in una struttura dati tramite json_decode. Questo file non contiene direttamente i dati degli studenti, ma il percorso del file XML che li contiene. In questo modo si separa la configurazione dei dati dalla loro struttura effettiva, rendendo il sistema più flessibile.

Il file XML viene quindi caricato tramite la classe DOMDocument. Prima del caricamento, viene verificata l’esistenza del file per evitare errori. Una volta caricato, il documento viene validato per assicurarsi che rispetti la struttura prevista (definita tramite DTD). Questo garantisce che i dati siano corretti e utilizzabili.

Per accedere ai dati contenuti nel file XML viene utilizzato DOMXPath, che permette di eseguire query strutturate. Le query vengono costruite utilizzando l’ID dell’utente salvato nella sessione, in modo da recuperare esclusivamente i dati relativi all’utente autenticato. In particolare, vengono estratti nome, cognome, data di nascita e classe.

Successivamente vengono recuperati anche i voti delle diverse materie. Per ogni materia viene eseguita una query specifica e il risultato viene salvato in un array associativo. Questo permette di organizzare i dati in modo chiaro e di utilizzarli facilmente nella fase di visualizzazione.

Dal punto di vista dell’interfaccia grafica, la pagina mostra un messaggio di benvenuto personalizzato con il nome e cognome dell’utente, seguito dalle informazioni principali. I voti vengono visualizzati all’interno di una tabella, rendendo la lettura più ordinata. Un aspetto interessante è l’utilizzo del colore per evidenziare i voti: se il voto è maggiore o uguale a 6 viene mostrato in verde, altrimenti in rosso. Questo migliora l’usabilità e permette una comprensione immediata dei risultati.

Infine, è presente un link per effettuare il logout (logout.php), che consente all’utente di terminare la sessione in modo sicuro.

In conclusione, dashboard.php rappresenta la parte finale del flusso del progetto: dopo la registrazione e il login, l’utente può accedere ai propri dati personali e ai voti. Questo file integra diverse tecnologie, tra cui gestione delle sessioni, lettura di file JSON, parsing di XML e visualizzazione dinamica dei dati, dimostrando una buona integrazione tra le varie componenti del sistema.

Il file logout.php ha il compito di gestire la disconnessione dell’utente dal sistema. Anche se il codice è molto breve, svolge una funzione importante per la sicurezza e la corretta gestione delle sessioni.

All’inizio viene richiamata la funzione session_start(), necessaria per accedere alla sessione attiva dell’utente. Senza questo passaggio non sarebbe possibile modificare o distruggere i dati di sessione.

Successivamente viene utilizzata la funzione session_unset(), che rimuove tutte le variabili salvate nella sessione, come ad esempio l’ID dell’utente e lo username. Questo serve a eliminare le informazioni che identificano l’utente all’interno del sistema.

Dopo aver svuotato la sessione, viene chiamata session_destroy(), che elimina completamente la sessione dal server. Questo garantisce che l’utente non sia più considerato autenticato e che non possa accedere alle pagine protette senza effettuare nuovamente il login.

Infine, tramite la funzione header("Location: index.html"), l’utente viene reindirizzato alla pagina iniziale del sito. Questo passaggio migliora l’esperienza utente e completa il processo di logout in modo chiaro e immediato.

In conclusione, logout.php rappresenta l’ultima fase del flusso di autenticazione: dopo il login e l’accesso alla dashboard, permette di terminare la sessione in modo sicuro, impedendo accessi non autorizzati successivi.

