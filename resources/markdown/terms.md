# Guia del Projecte: Plataforma de Vídeos

## Descripció del Projecte

Aquest projecte consisteix en una plataforma per gestionar i visualitzar vídeos, organitzats en sèries perquè els usuaris els puguin veure de manera fàcil i atractiva. El backend està desenvolupat amb **Laravel**, utilitzant **Carbon** per al tractament de dates. També compta amb un frontend intuïtiu per presentar els vídeos d'una forma amigable i accessible per als usuaris.

---

## Sprint 1: Configuració Inicial i Migracions

Durant el primer sprint es va realitzar la configuració inicial del projecte, anomenat **VideosApp**.  
Es va crear un projecte Laravel i es van instal·lar les dependències necessàries, a més de configurar una base de dades amb **SQLite3**. Per assegurar un bon funcionament del projecte, es van implementar helpers per facilitar la creació d'usuaris en els tests.  

Es van solucionar alguns problemes detectats en les migracions i es va ajustar la lògica perquè totes les entitats disposessin de les columnes correctes. Finalment, es va verificar que la base de dades funcionava adequadament, utilitzant una base de dades en memòria durant els tests per simplificar les proves i garantir un entorn consistent.

---

## Sprint 2: Funcionalitat de Vídeos i Proves

En aquest segon sprint es van corregir diversos errors identificats al primer sprint, especialment en la configuració de la base de dades temporal per als tests. Es va crear una nova migració per a la taula de vídeos, definint els camps necessaris per gestionar-los adequadament.

Es va implementar el controlador **VideosController**, amb les funcions principals `testedBy` i `show`, i es va desenvolupar el model **Video** amb diverses funcions per gestionar i formatar les dates de publicació gràcies a la llibreria **Carbon**. També es va afegir un helper per generar vídeos per defecte, juntament amb usuaris i vídeos predeterminats a la base de dades per simplificar les proves.  

Es va dissenyar un layout anomenat **VideosAppLayout**, implementant una vista i una ruta per mostrar els vídeos d'una manera organitzada.

---

## Sprint 3: Spatie rols i modificacions

En aquest tercer sprint es van realitzar diverses millores en els tests, permisos i estructura del projecte.

En l'àmbit dels tests, es va afegir UserRoleTest per verificar el comportament dels rols d'usuari, es van corregir errors a VideosDateTest relacionats amb les dates dels vídeos, i es van actualitzar diversos tests amb petits ajustos per garantir-ne la fiabilitat.

Pel que fa als permisos i polítiques, es va crear VideoPolicy per gestionar els accessos als vídeos mitjançant Gates, es van modificar els Helpers i permisos utilitzant Spatie, i es va instal·lar aquesta llibreria, afegint nous mètodes al model User per a una millor gestió dels permisos.

En el bloc de correccions i millores, es van corregir diversos errors menors, com la ruta del namespace de VideosTest, el camp testedBy a VideosController i la ubicació de VideosTest per garantir que estigués en el lloc adequat.

Finalment, es va establir l’estructura inicial del projecte en base al segon sprint, consolidant la feina prèvia i preparant el camí per a futurs desenvolupaments.
