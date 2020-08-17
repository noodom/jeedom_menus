# Menu menuVerticalTom avec fichier de configuration JSon et gestion de navigation par Frame
![Menu menuVerticalTom](./doc/images/menuOuvert.png)

![Menu menuVerticalTom](./doc/images/menuFerme.png)

Ce menu reprend le menu vertical de @Tom's avec :
- ajout de la gestion des boutons par un paramétrage JSon
- ajout de la navigation par frame à l'aide de htmlDisplay

La personnalisation est effectuée depuis un fichier de configuration JSON (/json/perso.json).

La navigation est effectuée en naviguant sur les designs correspondant à chaque bouton. 
Il y a la possibilité de naviguer à l'aide d'une frame, permettant de ne pas devoir recharger le menu à chaque changement d'écran.

## Installation du menu

### Avant d'inclure le menu, il faut commencer par les actions suivantes

   - Copier les dossiers **/css**, **/img** et **/json** dans le répertoire **/html/montheme/menuVerticalTom** à l'aide du plugin jeeExplorer

   - Editer le fichier **/json/perso.json** à l'aide du plugin jeeXplorer :
        - Pour chaque bouton du menu, mettre le lien vers un design (**link**) et le lien vers son image (**icon**)
   - Adapter si nécessaire les paramètres du menu et de la frame pour son affichage : voir détail plus bas
   - Vérifier que le fichier **/json/perso.json** modifié est correct :
        - Copier son contenu ici : https://jsonlint.com/
        - Cliquer sur **'Validate JSON'**
        - Le résultat sous Results doit être vert avec le message **'Valid JSON'**

### 2 possibilités pour l'installation (solution 2 à privilégier)
	- 1. Chargement d'un nouveau design à chaque sélection de bouton du menu : tous les designs doivent contenir le menu et le contenu de la page correspondante
	- 2. Gestion par frame :
		Un design contient le menu et les autres designs ne contiennent que le contenu des pages correspondantes à chaque bouton du menu (plus besoin d'inclure le menu sur chaque page)

#### Solution 1 : **chargement d'une nouvelle page à chaque sélection de bouton** (avec le menu inclus dans toutes les pages de Design)
	- Créer un équipement htmlDisplay (depuis le plugin htmlDisplay) et copier le contenu de index.html dans l'onglet Dashboard
	- Créer les Designs de la largeur et de la hauteur de l'écran final (ordinateur, mobile, tablette, ..) pour chaque lien du menu
	- Ajouter l'équipement htmlDisplay dans chacun de ces Designs (menu clic-droit, sélectionner "ajouter équipement" et sélectionner le htmlDisplay créé)
	- Positionner le htmlDisplay avec pour paramètres d'affichage positionX=0, positionY=280, Largeur=100, Hauteur=720 (facultatif : recalculé depuis les paramètres du fichier de configuration Json)
	- Ajouter les équipements à afficher dans chaque Design du menu (lumières, portes, fenêtres, volets, etc..)

#### Solution 2 : **chargement des pages dans une FRAME** (code index.html du menu présent dans un seul Design)
	- Créer un équipement htmlDisplay (depuis le plugin htmlDisplay) et copier le contenu de **index.html** dans l'onglet Dashboard
	- Créer un seul nouveau design de la largeur et de la hauteur de l'écran final (ordinateur, mobile, tablette, ..)
	- Ajouter l'équipement htmlDisplay dans ce Design (menu clic-droit, sélectionner "ajouter équipement" et sélectionner le htmlDisplay créé)
	- Positionner le htmlDisplay avec pour paramètres d'affichage positionX=0, positionY=280, Largeur=100, Hauteur=720 (facultatif : recalculé depuis les paramètres du fichier de configuration Json)
	- Créer un équipement htmlDisplay (depuis le plugin htmlDisplay) et copier le code suivant dans l'onglet Dashboard (ne pas modifier 'menuFrame' pour un bon fonctionnement) :
		<iframe id="menuFrame" src="about:blank" style="width:100%;height:100%;border:none;"/>
	- Ajouter l'équipement htmlDisplay dans le Design créé précédemment : adapter sa taille en fonction de l'endroit et de la taille souhaités pour l'affichage du contenu des menus sélectionnés (facultatif : recalculé depuis les paramètres du fichier de configuration Json)
	- Créer un Design pour chaque lien des boutons du menu (Prévoir de respecter la taille du Design en fonction de l'affichage final dans la frame)
	- Ajouter les équipements à afficher dans chaque Design du menu (lumières, portes, fenêtres, volets, etc..)

#### Paramétrage du menu (modification du fichier /html/montheme/menuVerticalTom/json/perso.json et SEULEMENT ce fichier)
	- buttons : liste des boutons du menu
		- modifier les valeurs label (Libellé du bouton), link (lien vers l'id d'un design) et color (couleur du bouton) pour personnaliser les boutons du menu
	- parameters
		- menu_x : position x du menu (par défaut "0px")
		- menu_y : position y du menu (par défaut "280px")
		- menu_width : largeur du menu (par défaut "100px")
		- menu_height : hauteur du menu (par défaut "720px")
		- content_x : position x du contenu du menu (par défaut "0px")
		- content_y : position y du contenu du menu (par défaut "0px")
		- content_width : largeur du contenu du menu (par défaut "1280px")
		- content_height : hauteur du contenu du menu (par défaut "1000px")

>Pour information, les avantages de la gestion de la navigation du menu par frame (Solution 2) :
>	- Le code du menu est présent dans un seul Design : plus simple en cas de modifications nécessaires (un seul Design à modifier), pas de recopie nécessaire, pas d'oublis de modifications sur différents écrans
>	- Les Designs de chaque bouton ne contiennent pas le code du menu :
>		- On construit chaque écran lié à un bouton sans se soucier du menu choisi
>		- On peut changer de menu sans modifier le contenu des écrans liés aux boutons : il suffit de créer autant de Design que de menus et ensuite, on appelle le design correspondant à un menu
>			Exemple : on crée un Design pour la navigation depuis un ordinateur, un autre menu pour une navigation depuis le mobile, un autre menu pour une navigation depuis une tablette.

>**Note** : il n'y a plus besoin de modifier le code (moins de risque d'erreur)
>
>Seul le fichier perso.json est à adapter à son menu

>### Création d'un équipement du plugin Html Display pour ajout dans un Design
>
>   - Depuis le plugin HTML Display, créer un nouvel équipement
>   - Recopier le contenu du fichier index.html dans cet équipement et sauvegarder
>   - Depuis un design, passer en mode édition (Clic droit, puis sélectionner 'Edition')
>   - Clic droit, puis sélectionner **'Ajouter équipement'**
>   - Sélectionner l'équipement HTML Display créé précédemment
>   - Redimensionner cet équipement

>**Note** : On aura au final l'arborescence suivante (A vérifier avec le plugin jeeExplorer) :
>
>- /html
>    - /montheme
>        - /menuVerticalTom  
>            - /css/perso.css : le css du menu (Modification non nécessaire)
>            - /img : les images du menu
>            - /json/perso.json : le json de personnalisation du menu (A personnaliser)
