# Homepage Governance

## Obiettivo

Mantenere predict.local/it coerente con l'architettura del repository: homepage minimale nel tema, contenuti governati dal CMS, configurazione da backoffice e zero drift verso landing hardcoded dentro la route Blade.

## Regole

### 1. Una sola homepage canonica

La configurazione CMS deve avere un solo record con slug home.

- corretto: un solo JSON o una sola pagina con slug home
- errato: piu file o piu record attivi con slug home

I file alternativi o sperimentali devono usare slug diversi, ad esempio:

- home-kalshi-legacy
- home-empty-legacy

### 2. pages/index.blade.php deve restare minimale

Per Themes/TwentyOne, la homepage canonica e un entrypoint Folio/Volt minimale con x-layouts.app, @volt('home') e x-page side="content" slug="home".

Il layout della homepage deve comunque ricevere metadati minimi espliciti dal file pagina:
- `title`
- `meta-description`

Questi valori non devono restare al default framework (`Laravel`) quando la pagina pubblica e' in produzione o in verifica runtime.

Motivo:

- la route homepage non deve diventare una landing hardcoded;
- il tema deve restare versatile e agnostico;
- il contenuto deve poter essere governato da JSON e backoffice;
- altri agenti non devono trovare logica o copy sparsi nel file route.

### 3. I contenuti homepage vivono nei blocchi CMS e JSON

Hero, trust bar, mercati in evidenza, FAQ, CTA e layout editoriale devono essere definiti tramite pagine e blocchi CMS, preferibilmente persistiti come JSON e gestibili con Filament Builder.

Motivo:

- riduce il coupling tra tema e dominio;
- permette configurazione da backoffice;
- facilita riuso del tema in altri progetti;
- rende il lavoro multi-agente piu componibile.

### 3.b Traduzioni dei blocchi: naming stabile e configurabile

Le chiavi traduzione usate da homepage, listing e blocchi CMS devono seguire la forma:

- `namespace::contesto.collezione.key.tipo`

Esempi corretti:

- `predict::home.hero.title.label`
- `predict::home.hero.cta_learn.label`
- `predict::common.view.label`
- `predict::predict_table.empty_state.no_markets_available.message`

Esempi da evitare:

- `predict::hero.title` (usare `predict::home.hero.title.label`)
- `predict::home.hero.cta_learn` (manca `.label`)
- `predict::common.view` (manca `.label`)

### 3.c @push('styles') solo in casi estremi

Usare una linea comune in tutto il sito. `@push('styles')` solo in caso estremo documentato. Il CSS va in `app.css` del tema.

Motivo:

- i blocchi JSON devono restare serializzabili e mappabili da Builder;
- la semantica della chiave deve essere leggibile anche senza aprire il file lingua;
- il tema resta agnostico e non dipende da scorciatoie semantiche del dominio.

### 4. Il tema non deve hardcodare copy o claim di dominio

Il tema non deve contenere in pages/index.blade.php:

- claim Predict-specifici;
- statistiche marketing statiche;
- demo inventate;
- trust badge non verificabili;
- markup custom che duplica blocchi gia gestibili dal CMS.

### 4.b La checklist del front office e' un gate obbligatorio

Per la homepage e per ogni pagina pubblica del tema, [website-checklist.md](/var/www/_bases/base_predict_fila5/docs/project/website-checklist.md) non e' opzionale ma vincolante.

Conseguenze operative:

- nessun link interno puo' uscire senza prefisso lingua corrente;
- nessun blocco puo' mostrare mock, demo fittizie o placeholder di business;
- nessun blocco puo' rimanere "formalmente presente ma visivamente vuoto" come una griglia senza card renderizzate;
- debugbar, dump e payload diagnostici non devono comparire nell'HTML pubblico;
- se una Blade richiede piu' di wiring minimale, la logica va spostata in Action PHP.
- se un blocco homepage contiene un form pubblico, il contratto corretto e' un widget Filament;
- se un blocco homepage contiene una griglia o lista di record con interazioni di dominio, il contratto corretto e' un `TableWidget` Filament, anche quando il rendering finale e' a card.

### 5. I lookup CMS per slug devono essere univoci

Quando il dominio si aspetta una sola pagina per slug, il codice deve usare sole() e non first().

Motivo:

- first() nasconde duplicati;
- sole() rende esplicita la violazione del contratto;
- il problema emerge subito in sviluppo invece di diventare comportamento casuale.

### 6. Il footer non deve dipendere dall'ordine dei blocchi

Il footer deve cercare i blocchi per type o per semantica del blocco, non per posizione numerica nell'array.

## Hero cinematico (blocco hero.cinematic)

Il blocco `pub_theme::components.blocks.hero.cinematic` fornisce l'hero homepage con:

- Palette scura (#0a0e1a, slate, indigo)
- Film grain e vignette per effetto cinematografico
- Orbs animati, griglia, particles
- Statistiche e mercati risolti da `Themes\TwentyOne\Actions\Hero\ResolveCinematicHeroDataAction`
- Mercati in evidenza con card e progress bar
- Route: `container0.view` e `container0.list` per predicts

Regola operativa:

- nessuna query Eloquent diretta dentro `cinematic.blade.php`;
- in caso di failure del layer dati, il blocco deve degradare con fallback sicuro e non rompere l'intera homepage.

La trust bar (`pub_theme::components.blocks.trust.bar`) usa tema scuro coerente (bg-slate-900/95).

## Stato attuale

- copertura regola homepage canonica: 100%
- copertura regola index.blade.php minimale: 100%
- copertura regola JSON/CMS-first homepage: 100% come governance, da verificare nei contenuti effettivi
- copertura regola lookup univoco slug CMS: 100% sui punti corretti toccati
- copertura regola footer order-independent: 100%
- copertura gate checklist obbligatoria: 100% come governance, da verificare continuamente a runtime

## Verifica

- Homepage route file: Themes/TwentyOne/resources/views/pages/index.blade.php
- CMS render path: x-page side="content" slug="home"
- Riferimento backoffice: Filament Builder per blocchi JSON configurabili
- Governance protetta da test e documentazione CMS/theme correlate


### 7. Il listing pubblico non deve sparire a volume zero

La pagina pubblica `predicts` deve mostrare anche mercati nuovi con volume ancora nullo, se sono pubblicabili e hanno titolo.

Motivo:

- un mercato appena creato non deve sembrare "assente";
- il CMS deve poter comporre listing editoriali senza dipendere da attivita' di trading gia' presente;
- l'empty state va mostrato solo quando davvero non esistono record pubblicabili.


### 8. Il footer globale appartiene al layout, non alla pagina home

Il footer canonico del frontoffice e' quello renderizzato da `x-section slug="footer"` dentro `pub_theme::components.layouts.app`.

Conseguenze operative:

- `home.json` non deve contenere un blocco `footer` dedicato;
- i blocchi pagina della homepage non devono puntare a viste legacy come `predict::components.blocks.home.footer`;
- eventuali footer Predict-specifici dentro i blocchi homepage sono fuori contratto CMS-first e vanno rimossi o neutralizzati.

### 9. Il blocco featured_markets deve avere cards reali o empty state esplicito

Il blocco `pub_theme::components.blocks.markets.featured_grid` non puo' limitarsi a mostrare titolo, contatori e CTA lasciando la griglia senza contenuti.

Contratto minimo:

- usa solo dati reali dal dominio Predict;
- localizza gli URL con la lingua corrente;
- mostra card reali con titolo, stati e outcome, oppure un empty state esplicito;
- non usa mock, immagini random o percentuali hardcoded.
- a regime deve convergere su un `TableWidget` o su una view card alimentata da una tabella Filament, cosi' ricerca, filtri e sorting restano disponibili senza riscrivere la logica in Blade.

### 10. Liste e griglie pubbliche usano widget Table di Filament

Quando una sezione homepage mostra una collezione di mercati con ricerca, filtri, ordinamento o paginazione, non si implementa una griglia manuale separata dal dominio.

Pattern obbligatorio:

- creare o riusare un `TableWidget` Filament;
- lasciare alla table la responsabilita' di query, search, filters, sorting, pagination e layout responsive;
- usare nelle righe una view minimale o un componente gia' normalizzato;
- il blocco CMS homepage fa solo da contenitore editoriale attorno al widget.
