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
