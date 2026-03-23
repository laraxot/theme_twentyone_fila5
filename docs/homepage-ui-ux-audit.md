# TwentyOne Homepage UI/UX Audit

Documento operativo per migliorare la homepage `predict.local/it` del tema `TwentyOne` incrociando stato reale del progetto e linee guida UI/UX research-backed.

## Obiettivo

Rendere la homepage piu' bella, piu' chiara e piu' credibile, senza fingere un livello di maturita' del prodotto che il backend non supporta ancora.

## Principi guida

- **chiarezza prima di spettacolo**
- **trust prima di decorazione**
- **una CTA primaria per hero**
- **navigazione semplice e non ridondante**
- **homepage come orientamento, non come dumping di widget**

## Stato percepito attuale

### Punti forti
- il tema ha gia' molti blocchi marketing e market-oriented
- la homepage risponde da guest
- esistono superfici per hero, markets, leaderboard, CTA, stats, trust

### Punti deboli
- il messaggio principale della homepage non emerge subito
- header e footer risultano visivamente ridondanti
- la homepage rischia di sembrare una raccolta di blocchi invece di un percorso
- search, categorie e mercati in evidenza competono troppo tra loro
- alcune superfici possono apparire piu' mature del backend reale

## Findings runtime confermati

### 1. Footer con brand duplicato

La homepage attiva mostrava il logo sia nell'header che nel footer. Questo aumentava la ridondanza senza aggiungere fiducia.

Stato: corretto.

### 2. Mobile tabs con markup non valido

Il file `layouts/mobile_tabs.blade.php` aveva tag `<a>` non chiusi correttamente, con rischio reale di comportamento UI incoerente su mobile.

Stato: corretto.

### 3. CTA footer delle card non coerente

Le card dei mercati mostravano una CTA di puntata secondaria che non era il punto di ingresso migliore nella homepage. La card ha gia' azioni di puntata sul corpo e deve tenere il footer piu' semplice.

Stato: corretto semplificando il footer action layer.

### 4. Homepage senza focus forte su un solo messaggio

Il contenuto attivo porta rapidamente ai mercati, ma manca ancora una hero/intro di livello homepage con proposta di valore esplicita.

Stato: aperto.

### 5. Delta reale rispetto ai competitor

Dall'analisi delle homepage leader del settore emergono quattro pattern ricorrenti:

- promessa di valore leggibile in pochi secondi;
- accesso immediato ai mercati;
- spiegazione rapida di come funziona;
- trust chiaro su regole e rischio.

Stato: corretto in buona parte sulla homepage canonica introducendo hero, blocco onboarding/trust e CTA finale.

## Regole UI/UX da applicare

### 1. Hero con proposta di valore netta

La prima schermata deve spiegare in pochi secondi:

- cos'e' Predict
- perche' e' diverso
- quale azione iniziare

Per `predict.local/it` la hero dovrebbe comunicare:
- prediction market con crediti virtuali a tappi di bottiglia
- mercati chiari e immediati
- partecipazione senza frizione

### 2. Una CTA primaria, una secondaria

Oggi il rischio e' avere troppi punti di ingresso. La hero deve avere:

- CTA primaria: `Esplora i mercati`
- CTA secondaria: `Come funziona`

### 3. Search come fallback, non come protagonista assoluta

La ricerca deve essere molto visibile ma non mangiare il messaggio di valore.

### 4. Navigazione con scope chiaro

La navbar deve chiarire subito i 3 ambiti principali:

- Mercati
- Classifica
- Come funziona

Tutto il resto va secondarizzato o spostato in dropdown meno invasivi.

### 5. Trust immediato sopra la piega

Subito dopo la hero servono segnali di fiducia:

- soldi virtuali / tappi di bottiglia
- nessun rischio reale
- regole trasparenti
- mercati chiusi e risolti in modo verificabile

### 6. Prima i mercati, poi il marketing

La homepage di un prediction market deve mostrare presto mercati utili, non solo claim.

Ordine raccomandato:

1. Hero
2. trust strip
3. mercati in evidenza
4. categorie
5. leaderboard / social proof
6. spiegazione semplice del funzionamento
7. CTA finale

### 7. Ridurre la ridondanza visiva

Se il logo o i blocchi social dominano sia header che footer, l'effetto e' dispersione. Il footer deve chiudere la pagina, non competere con l'header.

### 8. Mobile-first reale

La homepage deve evitare:

- caroselli poco controllabili
- liste troppo lunghe
- hit targets piccoli
- testo compresso

## Interventi consigliati per `TwentyOne`

### Priorita' P0

- semplificare l'header riducendo elementi simultanei
- eliminare o ridurre la duplicazione del brand tra header e footer
- introdurre una hero unica e piu' netta
- aggiungere una trust strip con 3-4 punti chiari
- portare i mercati in evidenza sopra elementi accessori

Stato attuale P0:

- hero unica: `100%`
- blocco onboarding/trust: `100%`
- ordine homepage piu' leggibile: `80%`
- semplificazione header: `40%`
- rifinitura footer: `70%`

### Priorita' P1

- scegliere un solo blocco mercati principale per la homepage
- spostare ricerca e categorie in una sezione ordinata sotto la hero
- usare una gerarchia tipografica piu' marcata
- migliorare spacing verticale per separare i blocchi

### Priorita' P2

- introdurre micro-stati onesti: `mercato aperto`, `in risoluzione`, `demo`, `dati reali`
- migliorare la consistenza tra homepage e pagina mercato
- aggiungere screenshot audit ricorrenti desktop/mobile

## Decisioni di design consigliate

### Header
- meno icone concorrenti
- nav primaria con 3-4 voci
- login/register visibili ma non dominanti

### Hero
- titolo forte e leggibile
- sottotitolo breve
- CTA doppia ben distinta
- immagine o card market reale, non astratta

### Market cards
- mostrare probabilita', volume e stato
- evitare numeri finti
- evidenziare il mercato principale con piu' contrasto

### Footer
- logo piu' piccolo o solo testuale
- link utili, compliance, social secondari
- niente “seconda homepage” nel footer

## Metriche UX da inseguire

- chiarezza del messaggio above the fold: target **90%**
- visibilita' CTA primaria: target **95%**
- ridondanza percepita header/footer: sotto **10%**
- accesso ai mercati in massimo 1 scroll: target **100%**


## Checklist operativa sito bello e usabile

Checklist derivata dall'audit interno e da fonti esterne su kinetic web design, web immersivo, micro-interazioni e accessibilita'.

### 1. Movimento con funzione, non ornamentale
- Le animazioni devono guidare focus, gerarchia e orientamento.
- Particles e orb non devono ridurre il contrasto del copy o coprire CTA e percentuali.
- Ogni sezione above the fold deve restare leggibile anche con motion disattivata.

### 2. Homepage dinamica ma non confusa
- La hero deve spiegare cosa fa il prodotto in meno di 5 secondi.
- Il primo scroll deve mostrare mercati reali o segnali di trust, non solo decorazione.
- Nessun blocco deve sembrare finto, gonfiato o piu' maturo del backend reale.

### 3. Micro-interazioni con feedback chiaro
- Hover, active, loading e modal devono confermare sempre cosa e' cliccabile.
- Le card mercato devono far capire subito che il click porta al detail o apre approfondimento.
- Barre percentuali, immagini outcome e CTA devono avere stati coerenti tra homepage, listing e detail.

### 4. Accessibilita' come quality gate
- Contrasto reale sufficiente tra testo e sfondo anche nelle superfici cinematiche.
- Focus visible sempre presente su link, card, CTA, filtri e controlli mobili.
- Touch target minimo 44x44 per elementi interattivi.
- Reduced motion rispettato senza rompere layout o significato.

### 5. Credibilita' del prodotto
- Claim sinceri: niente leadership o social proof non dimostrabili.
- I numeri devono provenire da DB o degradare a zero/fallback onesto.
- I mercati home devono privilegiare multi-outcome con immagini e dati persistiti.

## Stato audit 2026-03-20

- Runtime locale `http://predict.local/it`: di nuovo operativo con `200 OK` dopo correzione header HTTP locale, fix block stats e fix provider Folio localization.
- Screenshot headless automatico: non affidabile in questo ambiente per limiti snap/mount di Chromium; audit visuale da rifare con browser non confinato o altro tool.
- Prossimo gate consigliato: verificare desktop + mobile reali e aggiornare questo documento con finding visivi puntuali.

## Audit autonomo runtime + visuale (2026-03-20)

Audit eseguito in autonomia su:

- `http://predict.local/it`
- `http://predict.local/it/predicts`

### Esito rapido

- Endpoint runtime attuali: `200` su entrambe le pagine.
- Rimangono criticita' visuali e di coerenza UX su `/it/predicts`.

### Findings prioritizzati

#### Critical

- Errore SQL intermittente osservato in audit precedente su `/it/predicts`:
  - `Unknown column 'sum_credit_yes' in order clause`
  - impatto: listing bloccato in alcune esecuzioni.

#### High

- Regressione i18n su `/it/predicts`: renderizzate chiavi di traduzione in pagina.
- Contrasto insufficiente in sezioni listing (leggibilita' bassa).
- Overlay/shape grafica invasiva che riduce chiarezza del contenuto.
- Listing non percepito come "tabellare" coerente con obiettivo prodotto.

#### Medium

- Alcuni link principali non esplicitamente localizzati (`/it/...`) ma relativi.
- Coerenza CTA tra hero home e listing da riallineare.

### Evidenze screenshot

- `screenshots/audit-home-hero-it.png`
- `screenshots/audit-home-predicts-section-it.png`
- `screenshots/audit-predicts-hero-it.png`
- `screenshots/audit-predicts-listing-it.png`

### Decisione operativa DRY + KISS

- mantenere cinematic forte in hero;
- ridurre motion/overlay nelle superfici data-heavy (`/predicts`);
- centralizzare link localizzati e rendering listing in un solo componente sorgente;
- usare fallback schema-aware lato query per evitare regressioni runtime su colonne aggregate.

## Prossima wave consigliata

1. rifare hero + trust strip
2. semplificare header
3. ridurre footer
4. scegliere il blocco mercati migliore
5. verificare desktop e mobile con screenshot comparativi
