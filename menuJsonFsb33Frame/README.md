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

▶️ Avant d'inclure le menu, il faut commencer par les actions suivantes

   - Créer le scénario d'installation automatique d'un menu noodom, si premier menu généré (disponible [ici](../installation/README.md))
   - Préciser le nom du menu **menuJsonFsb33Frame** dans le tag **menuName** du scénario (Détail des autres tags dans la procédure pour les autres tags)
   - Exécuter le scénario => Le design du menu est créé automatiquement
   - Editer le fichier **/json/perso.json** à l'aide de l'éditeur de fichier (plugin jeeExplorer ou menu Réglages/Système/Editeur de fichiers à partir de Jeedom 4.2) :
        - Pour chaque bouton du menu, mettre le lien vers un design (**link**) et le lien vers son image (**icon**)
        - (Optionnel) Pour chaque bouton du menu, préciser le mode plein écran du contenu (**fullscreen**), utile pour les écrans de Jeedom (designs, panels, ..) : 0=menu Jeedom visible, 1=menu Jeedom caché (par défaut 1 si top=0)
        - (Optionnel) Pour chaque bouton du menu, préciser le mode d'ouverture du lien (**top**) : 0=ouverture dans la frame de contenu, 1=ouverture en remplacement de la page du menu, 2=ouverture dans une nouvelle fenêtre
   - Adapter si nécessaire les paramètres du menu et de la frame pour son affichage : voir détail plus bas
   - (Optionnel) Vérifier que le fichier **/json/perso.json** modifié est correct :
        - Copier son contenu ici : https://jsonlint.com/
        - Cliquer sur **'Validate JSON'**
        - Le résultat sous Results doit être vert avec le message **'Valid JSON'**

▶️ Création du menu
   - Créer un Design pour chaque lien des boutons du menu si pas encore existants (Prévoir de respecter la taille du Design en fonction de l'affichage final dans la frame)
		- Ces menus ne contiennent pas le menu mais seulement les éléments de Jeedom à visualiser pour cet écran
		- Préciser ces liens dans le fichier de configuration **/json/perso.json** pour la navigation du menu si nécessaire
   - (Indépendant du menu) Ajouter les équipements à afficher dans chaque Design du menu (lumières, portes, fenêtres, volets, etc..)

▶️ Paramétrage du menu (modification du fichier **/html/data/menusNoodom/menuJsonFsb33Frame/json/perso.json** et SEULEMENT ce fichier)
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

>**Note** : Le paramètre **icon** d'un bouton peut être au format image (ex : "icon": "data/menusNoodom/menuJsonFsb33Frame/img/icon_home.png"), mais aussi au format font-awesome (ex: "icon" : "fa fa-4x fa-home")

>Pour information, les avantages de la gestion de la navigation du menu par frame :
>	- Le code du menu est présent dans un seul Design : plus simple en cas de modifications nécessaires (un seul Design à modifier), pas de recopie nécessaire, pas d'oublis de modifications sur différents écrans
>	- Les Designs de chaque bouton ne contiennent pas le code du menu :
>		- On construit chaque écran lié à un bouton sans se soucier du menu choisi
>		- On peut changer de menu sans modifier le contenu des écrans liés aux boutons : il suffit de créer autant de Designs que de menus et ensuite, on appelle le design correspondant à un menu
>			Exemple : on crée un Design pour la navigation depuis un ordinateur, un autre menu pour une navigation depuis le mobile, un autre menu pour une navigation depuis une tablette.

>**Note** : il n'y a plus besoin de modifier le code (moins de risque d'erreur)
>
>Seul le fichier **/json/perso.json** est à adapter à son menu

>**Note** : On aura au final l'arborescence suivante (A vérifier avec l'éditeur de fichier) :
>
>- /html
>    - /data
>       - /menusNoodom
>          - /menuJsonFsb33Frame  
>             - /css/perso.css : le css du menu (Modification non nécessaire)
>             - /img : les images du menu
>             - /json/perso.json : le json de personnalisation du menu (A personnaliser)
