# Menu jsonFsb33Frame avec fichier de configuration JSon et gestion de navigation par Frame
![Menu jsonFsb33Frame](./doc/images/menuJsonFsb33Frame.png)

Ce menu reprend le menu F$B33 simplifié par @salvialf
- ajout de la gestion des boutons par un paramétrage JSon
- ajout de la navigation par frame à l'aide de htmlDisplay

La personnalisation est effectuée depuis un fichier de configuration JSON (**/html/data/menusNoodom/menuJsonFsb33Frame/json/perso.json**).

La navigation est effectuée en naviguant sur les designs correspondant à chaque bouton. 
Il y a la possibilité de naviguer à l'aide d'une frame, permettant de ne pas devoir recharger le menu à chaque changement d'écran.

>**Note** : il est possible de forcer directement le contenu d'un design à l'ouverture du design du menu
>
> Il suffit d'ajouter l'id du design souhaité dans le paramètre link_id, par exemple le menu (installé dans le design 73) affichera par défaut le contenu du design 58 :
> http://monJeedom/index.php?v=d&p=plan&plan_id=73&link_id=58&fullscreen=1

## Installation du menu

### Avant d'inclure le menu, il faut commencer par les actions suivantes

   - Récupérer le template de scénario [nooMenusFilesDownload](../nooMenusFilesDownload.json)
        - Installer le scénario à partir du template
        - Préciser la valeur menuJsonFsb33Frame pour le tag menuName en début de scénario
        - Exécuter le scénario => Les fichiers du scénario sont bien recopiés
   - Editer le fichier **/json/perso.json** de l'éditeur de fichier :
        - Pour chaque bouton du menu, mettre le lien vers un design (**link**) et le lien vers son image (**icon**)
   - Adapter si nécessaire les paramètres du menu et de la frame pour son affichage : voir détail plus bas
   - (Optionnel) Vérifier que le fichier **/json/perso.json** modifié est correct :
        - Copier son contenu (en supprimant la première et dernière ligne du fichier et en supprimant les quotes en début et fin de lignes) ici : https://jsonlint.com/
        - Cliquer sur **'Validate JSON'**
        - Le résultat sous Results doit être vert avec le message **'Valid JSON'**

#### Création du menu
   - Créer un équipement htmlDisplay **'Contenu'** (depuis le plugin htmlDisplay) et copier le code de **menuFrame.html** dans l'onglet Dashboard (ne pas modifier 'menuFrame' pour un bon fonctionnement)
   - Créer un équipement htmlDisplay **'Menu'** (depuis le plugin htmlDisplay) et copier le code de **index.html** dans l'onglet Dashboard
		- Pour ces 2 équipements, cocher **'Activer'** et **'Visible'** puis **'Sauvegarder'**
   - Créer un seul nouveau Design de la largeur et de la hauteur de l'écran final (ordinateur, mobile, tablette, ..)
   - Créer un Design pour chaque lien des boutons du menu si pas encore existants (Prévoir de respecter la taille du Design en fonction de l'affichage final dans la frame)
		- Ces menus ne contiennent pas le menu mais seulement les éléments de Jeedom à visualiser pour cet écran
		- Préciser ces liens dans le fichier de configuration **/json/perso.json** pour la navigation du menu si nécessaire
   - Ajouter EN PREMIER l'équipement htmlDisplay **'Contenu'** dans ce même Design : adapter sa taille en fonction de l'endroit et de la taille souhaités pour l'affichage du contenu des menus sélectionnés (facultatif : recalculé depuis les paramètres du fichier de configuration Json)
   - Ajouter EN SECOND l'équipement htmlDisplay **'Menu'** dans ce Design (menu clic-droit, sélectionner "ajouter équipement" et sélectionner le htmlDisplay 'Menu')
   - Positionner le htmlDisplay en haut de l'écran, avec pour paramètres d'affichage positionX=0, positionY=0, Largeur=largeur écran, Hauteur=80 (facultatif : recalculé depuis les paramètres du fichier de configuration Json)
		- Adapter son z-index (clic droit, Paramètres d'affichage, profondeur : mettre niveau 3)
		- Cocher 'transparent' pour la couleur de fond (clic droit, Paramètres d'affichage, Couleur de fond : Transparent)
   - (Indépendant du menu) Ajouter les équipements à afficher dans chaque Design du menu (lumières, portes, fenêtres, volets, etc..)

#### Paramétrage du menu (modification du fichier **/html/data/menusNoodom/menuJsonFsb33Frame/json/perso.json** et SEULEMENT ce fichier)
   - buttons : liste des boutons du menu
   - modifier les valeurs **link** (lien vers l'id d'un design) et **icon** (image du bouton) pour personnaliser les boutons du menu
   	- parameters
		- menu_x : position x du menu (par défaut "0px")
		- menu_y : position y du menu (par défaut "0px")
		- menu_width : largeur du menu (par défaut "1280px")
		- menu_height : hauteur du menu (par défaut "80px")
		- content_x : position x du contenu du menu (par défaut "0px")
		- content_y : position y du contenu du menu (par défaut "0px")
		- content_width : largeur du contenu du menu (par défaut "1280px")
		- content_height : hauteur du contenu du menu (par défaut "1000px")

>Pour information, les avantages de la gestion de la navigation du menu par frame (Solution 2) :
>	- Le code du menu est présent dans un seul Design : plus simple en cas de modifications nécessaires (un seul Design à modifier), pas de recopie nécessaire, pas d'oublis de modifications sur différents écrans
>	- Les Designs de chaque bouton ne contiennent pas le code du menu :
>		- On construit chaque écran lié à un bouton sans se soucier du menu choisi
>		- On peut changer de menu sans modifier le contenu des écrans liés aux boutons : il suffit de créer autant de Designs que de menus et ensuite, on appelle le design correspondant à un menu
>			Exemple : on crée un Design pour la navigation depuis un ordinateur, un autre menu pour une navigation depuis le mobile, un autre menu pour une navigation depuis une tablette.

>**Note** : il n'y a plus besoin de modifier le code (moins de risque d'erreur)
>
>Seul le fichier **/json/perso.json** est à adapter à son menu

>### Création d'un équipement du plugin Html Display pour ajout dans un Design
>
>   - Depuis le plugin HTML Display, créer un nouvel équipement
>   - Recopier le contenu du fichier index.html dans cet équipement et sauvegarder
>   - Depuis un design, passer en mode édition (Clic droit, puis sélectionner 'Edition')
>   - Clic droit, puis sélectionner **'Ajouter équipement'**
>   - Sélectionner l'équipement HTML Display créé précédemment
>   - Redimensionner cet équipement

>**Note** : On aura au final l'arborescence suivante (A vérifier avec l'éditeur de fichier) :
>
>- /html
>    - /data
>       - /menusNoodom
>          - /menuJsonFsb33Frame  
>             - /css/perso.css : le css du menu (Modification non nécessaire)
>             - /img : les images du menu
>             - /json/perso.json : le json de personnalisation du menu (A personnaliser)
