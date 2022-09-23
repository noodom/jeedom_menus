# Menu nooMobileFlip avec fichier de configuration JSon et gestion de navigation par Frame
![Menu nooMobileFlip](./doc/images/demoMenuNooMobileFlip.gif)

Ce menu pour mobile , affiché sur sélection du bouton Hamburger, s'ouvre par le bas en décalant le contenu vers le haut.
La gestion de son paramétrage est assurée par fichier JSon et sa navigation par frame.

La personnalisation est effectuée depuis un fichier de configuration JSON (**html/data/menusNoodom/menuNooMobileFlip/json/perso.json**).

La navigation est effectuée en naviguant sur les designs correspondant à chaque bouton. 
Il y a la possibilité de naviguer à l'aide d'une frame, permettant de ne pas devoir recharger le menu à chaque changement d'écran.

## Installation du menu

### Avant d'inclure le menu, il faut commencer par les actions suivantes

   - Récupérer le template de scénario [nooMenusFilesDownload](../nooMenusFilesDownload.json) ( Tuto détaillé [ici](../installation/README.md) )
        - Installer le scénario à partir du template
        - Préciser la valeur menuNooMobileFlip pour le tag menuName en début de scénario
        - Exécuter le scénario => Les fichiers du scénario sont bien recopiés
   - Editer le fichier **/json/perso.json** à l'aide de l'éditeur de fichier (plugin jeeExplorer ou menu Réglages/Système/Editeur de fichiers à partir de Jeedom 4.2) :
        - Pour chaque bouton du menu, mettre le libellé du bouton (**label**), le lien vers un design (**link**) et son icône fontawesome (**icon**)
        - Définir les positions et tailles des frames du menu et du contenu (détaillé ci-dessous)
   - (Optionnel) Vérifier que le fichier **/json/perso.json** modifié est correct :
        - Copier son contenu ici : https://jsonlint.com/
        - Cliquer sur **'Validate JSON'**
        - Le résultat sous Results doit être vert avec le message **'Valid JSON'**

#### Création du menu

>**Note** :
>
>  Gestion par frame : 
>  - Un design contient le menu et les autres designs ne contiennent que le contenu des pages correspondantes à chaque bouton du menu (plus besoin d'inclure le menu sur chaque page)
> - **chargement des pages dans une FRAME** : La frame est contenue dans le code du menu

   - Créer un équipement htmlDisplay **'Menu'** (depuis le plugin htmlDisplay) et copier le contenu de **index.html** dans l'onglet Dashboard
        - Pour cet équipement, cocher **'Activer'** et **'Visible'** puis **'Sauvegarder'**
   - Créer un seul nouveau Design de la largeur et de la hauteur de l'écran final (ordinateur, mobile, tablette, ..)
   - Créer un Design pour chaque lien des boutons du menu (Prévoir de respecter la taille du Design en fonction de l'affichage final dans la frame)
        - Ces menus ne contiennent pas le menu mais seulement les éléments de Jeedom à visualiser pour cet écran
        - Préciser ces liens dans le fichier de configuration **/json/perso.json** pour la navigation du menu si nécessaire
   - Ajouter l'équipement htmlDisplay **'Menu'** dans ce Design (menu clic-droit, sélectionner "ajouter équipement" et sélectionner le htmlDisplay 'Menu')
        - Sa position et sa taille seront définies par les paramètres dans le fichier **/json/perso.json**
        - Cocher 'transparent' pour la couleur de fond (clic droit, Paramètres d'affichage, Couleur de fond : Transparent)
   - (Indépendant du menu) Ajouter les équipements à afficher dans chaque Design du menu (lumières, portes, fenêtres, volets, etc..)

#### Paramétrage du menu (modification du fichier /data/menusNoodom/menuNooMobileFlip/json/perso.json et SEULEMENT ce fichier)

   - **buttons** : liste des boutons du menu

   - **parameters** : liste des paramètres du menu

	********** Paramètres des boutons ***************
	   
	label : libellé du bouton
	
	link : identifiant du design destinataire du lien du menu (ex : 51 pour un design d'url http://www.monjeedom.com/index.php?v=d&p=plan&plan_id=51)
		
	icon : icône fontawesome pour l'affichage du bouton correspondant (ex : "fas fa-home", liste à récupérer ici : https://fontawesome.com/icons?d=gallery&p=2&m=free)

	********** Paramètres du menu ***************

     css_file : nom du fichier de configuration css, à positionner dans le répertoire **/html/data/menusNoodom/menuNooMobileFlip/css** (par défaut "perso.css")

	menu_width : largeur du menu (par défaut "580px")

	menu_height : hauteur du menu (par défaut "1000px")
      
	button_color1 :  couleur 1 du dégradé de fond du menu (par défaut "rgb(150, 201, 39)")

	button_color2 :  couleur 2 du dégradé de fond du menu (par défaut "rgb(150, 201, 39)")

	button_color3 :  couleur 3 du dégradé de fond du menu (par défaut "gray")

	menu_background :  couleur de fond derrière le contenu quand le menu est ouvert (par défaut "#000")

	button_width :  largeur des boutons, en pourcentage "20%" (recommandé) ou en pixels "20px" (par défaut "20%")

	button_logo_color :  couleur du logo des boutons du menu (par défaut "white")

	button_title_color :  couleur du label des boutons du menu (par défaut "white")

	button_active_logo_color :  couleur du logo du bouton du menu sélectionné (par défaut "rgb(47, 47, 47)")

	button_active_title_color :  couleur du label du bouton du menu sélectionné (par défaut "rgb(47, 47, 47)")

	menu_button_background :  couleur de fond des boutons d'ouverture et fermeture du menu (par défaut "#282828")

	menu_open_hamburger : couleur du bouton d'ouverture (hamburger) du menu (par défaut "#fff")

	menu_close_cross :  couleur du bouton de fermeture (croix) du menu (par défaut "rgb(150, 201, 39)")

	rotation_angle : angle d'inclinaison du contenu à l'ouverture du menu  (par défaut "-45deg")

Pour information, les avantages de la gestion de la navigation du menu par frame :
- [x] Le code du menu est présent dans un seul Design : plus simple en cas de modifications nécessaires (un seul Design à modifier), pas de recopie nécessaire, pas d'oublis de modifications sur différents écrans
- [x] Les Designs de chaque bouton ne contiennent pas le code du menu
- [x] On construit chaque écran lié à un bouton sans se soucier du menu choisi
- [x] On peut changer de menu sans modifier le contenu des écrans liés aux boutons : il suffit de créer autant de Designs que de menus et ensuite, on appelle le design correspondant à un menu
   - Exemple : on crée un Design pour la navigation depuis un ordinateur, un autre menu pour une navigation depuis le mobile, un autre menu pour une navigation depuis une tablette.

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

>**Note** : On aura au final l'arborescence suivante (A vérifier avec l'éditeur de fichiers) :
>
>- /html
>    - /data
>       - /menusNoodom
>          - /menuNooMobileFlip
>            - /css/perso.css : le css du menu (Modification non nécessaire)
>            - /json/perso.json : le json de personnalisation du menu (A personnaliser)

