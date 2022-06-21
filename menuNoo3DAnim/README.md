# Menu noo3DAnim avec fichier de configuration JSon et gestion de navigation par Frame
![Menu noo3DAnim](./doc/images/demoMenuNoo3DAnim.gif)

Ce menu affiche des boutons 3D avec une animation sur focus pour le bouton sélectionné, les boutons du menu ayant chacun une couleur personnalisable.

La personnalisation est effectuée depuis un fichier de configuration JSON (**html/data/menusNoodom/menuNoo3DAnim/json/perso.json**).

La navigation est effectuée en naviguant sur les designs correspondant à chaque bouton. 
Il y a la possibilité de naviguer à l'aide d'une frame, permettant de ne pas devoir recharger le menu à chaque changement d'écran.

## Installation du menu

▶️ Avant d'inclure le menu, il faut commencer par les actions suivantes

   - Créer le scénario d'installation automatique d'un menu noodom, si premier menu généré (disponible [ici](../installation/README.md))
      - Préciser le nom du menu **menuNoo3DAnim** dans le tag **menuName** du scénario (Détail des autres tags dans la procédure pour les autres tags)
      - Exécuter le scénario => Le design du menu est créé automatiquement
   - Editer le fichier **/json/perso.json** à l'aide de l'éditeur de fichier (plugin jeeExplorer ou menu Réglages/Système/Editeur de fichiers à partir de Jeedom 4.2) :
        - Pour chaque bouton du menu, mettre le libellé du bouton (**label**), le lien vers un design (**link**), son icône fontawesome (**icon**) et sa couleur (**color**)
        - Définir les positions et tailles des frames du menu et du contenu (détaillé ci-dessous)
   - (Optionnel) Vérifier que le fichier **/json/perso.json** modifié est correct :
        - Copier son contenu ici : https://jsonlint.com/
        - Cliquer sur **'Validate JSON'**
        - Le résultat sous Results doit être vert avec le message **'Valid JSON'**

▶️ Création du menu

>**Note** :
>
>  Gestion par frame : 
>  - Un design contient le menu et les autres designs ne contiennent que le contenu des pages correspondantes à chaque bouton du menu (plus besoin d'inclure le menu sur chaque page)
> - **chargement des pages dans une FRAME** : code index.html du menu présent dans un seul Design

   - Créer un Design pour chaque lien des boutons du menu (Prévoir de respecter la taille du Design en fonction de l'affichage final dans la frame)
        - Ces menus ne contiennent pas le menu mais seulement les éléments de Jeedom à visualiser pour cet écran
        - Préciser ces liens dans le fichier de configuration **/json/perso.json** pour la navigation du menu si nécessaire
   - (Indépendant du menu) Ajouter les équipements à afficher dans chaque Design du menu (lumières, portes, fenêtres, volets, etc..)

▶️ Paramétrage du menu (modification du fichier /data/menusNoodom/menuNoo3DAnim/json/perso.json et SEULEMENT ce fichier)

   - **buttons** : liste des boutons du menu

   - **parameters** : liste des paramètres du menu

	********** Paramètres des boutons ***************
	   
	label : libellé du bouton
	
	link : identifiant du design destinataire du lien du menu (ex : 51 pour un design d'url http://www.monjeedom.com/index.php?v=d&p=plan&plan_id=51)
		
	icon : icône fontawesome pour l'affichage du bouton correspondant (ex : "fas fa-home", liste à récupérer ici : https://fontawesome.com/icons?d=gallery&p=2&m=free)

    color : couleur du bouton (ex "#4267B2")

	********** Paramètres du menu ***************
       
	menu_x : position x du menu (par défaut "0px")

	menu_y : position y du menu (par défaut "0px")
        
	menu_width : largeur du menu (par défaut "1280px")
        
	menu_height : hauteur du menu (par défaut "80px")
        
	content_x : position x du contenu du menu (par défaut "0px")
        
	content_y : position y du contenu du menu (par défaut "0px")
        
	content_width : largeur du contenu du menu (par défaut "1280px")
        
	content_height : hauteur du contenu du menu (par défaut "1000px")
        
	background_color : couleur de fond du menu (par défaut 'black')

    css_loading_timeout : temps d'attente en ms avant chargement des paramètres du menu (à augmenter si les paramètres des boutons ne sont pas pris en compte au chargement du menu)

	reload_active_button : 1 pour forcer le rechargement du contenu d'un bouton déjà sélectionné, 0 pour ne pas recharger le contenu

Pour information, les avantages de la gestion de la navigation du menu par frame :
- [x] Le code du menu est présent dans un seul Design : plus simple en cas de modifications nécessaires (un seul Design à modifier), pas de recopie nécessaire, pas d'oublis de modifications sur différents écrans
- [x] Les Designs de chaque bouton ne contiennent pas le code du menu :
- [x] On construit chaque écran lié à un bouton sans se soucier du menu choisi
- [x] On peut changer de menu sans modifier le contenu des écrans liés aux boutons : il suffit de créer autant de Design que de menus et ensuite, on appelle le design correspondant à un menu
   - Exemple : on crée un Design pour la navigation depuis un ordinateur, un autre menu pour une navigation depuis le mobile, un autre menu pour une navigation depuis une tablette.

>**Note** : il n'y a plus besoin de modifier le code (moins de risque d'erreur)
>
>Seul le fichier perso.js est à adapter à son menu

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
>          - /menuNoo3DAnim
>            - /css/perso.css : le css du menu (Modification non nécessaire)
>            - /json/perso.json : le json de personnalisation du menu (A personnaliser)

