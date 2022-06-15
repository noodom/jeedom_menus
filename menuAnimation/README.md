# Menu Animation avec fichier de configuration JSon et gestion de navigation par Frame
![Menu Animation](./doc/images/menuAnimation.png)

Ce menu affiche les boutons du menu avec une couleur personnalisable pour chacun.

La personnalisation est effectuée depuis un fichier de configuration JSON (**/html/data/menusNoodom/menuAnimation/json/perso.json**).

La navigation est effectuée en naviguant sur les designs correspondant à chaque bouton. 
Il y a la possibilité de naviguer à l'aide d'une frame, permettant de ne pas devoir recharger le menu à chaque changement d'écran.

## Installation du menu

### Avant d'inclure le menu, il faut commencer par les actions suivantes

   - Créer le scénario d'installation automatique d'un menu noodom (disponible [ici](../installation/README.md))
   - Préciser le nom du menu **menuAnimation** dans le tag **menuName** du scénario
   - Exécuter le scénario => Le design du menu est créé automatiquement
   - Editer le fichier **/html/data/menusNoodom/menuAnimation/json/perso.json** à l'aide de l'éditeur de fichier :
        - Pour chaque bouton du menu, mettre le libellé du bouton (**label**), le lien vers un design (**link**) et sa couleur (**color**)
   - (Optionnel) Vérifier que le fichier **/html/data/menusNoodom/menuAnimation/json/perso.json** modifié est correct :
        - Copier son contenu ici : https://jsonlint.com/
        - Cliquer sur **'Validate JSON'**
        - Le résultat sous Results doit être vert avec le message **'Valid JSON'**

#### Création du menu

   - Créer un équipement htmlDisplay **'Contenu'** (depuis le plugin htmlDisplay) et copier le code de **menuFrame.html** dans l'onglet Dashboard (ne pas modifier 'menuFrame' pour un bon fonctionnement)
   - Créer un équipement htmlDisplay **'Menu'** (depuis le plugin htmlDisplay) et copier le code de **index.html** dans l'onglet Dashboard
        - Pour ces 2 équipements, cocher **'Activer'** et **'Visible'** puis **'Sauvegarder'**
   - Créer un seul nouveau Design de la largeur et de la hauteur de l'écran final (ordinateur, mobile, tablette, ..)
   - Créer un Design pour chaque lien des boutons du menu (Prévoir de respecter la taille du Design en fonction de l'affichage final dans la frame)
        - Ces menus ne contiennent pas le menu mais seulement les éléments de Jeedom à visualiser pour cet écran
        - Préciser ces liens dans le fichier de configuration **/json/perso.json** pour la navigation du menu si nécessaire
   - Ajouter EN PREMIER l'équipement htmlDisplay **'Contenu'** dans ce même Design : adapter sa taille en fonction de l'endroit et de la taille souhaités pour l'affichage du contenu des menus sélectionnés
   - Ajouter EN SECOND l'équipement htmlDisplay **'Menu'** dans ce Design (menu clic-droit, sélectionner "ajouter équipement" et sélectionner le htmlDisplay 'Menu')
        - Positionner le htmlDisplay en haut de l'écran, avec pour paramètres d'affichage positionX=0, positionY=0, Largeur=largeur écran, Hauteur=120
        - Adapter son z-index (clic droit, Paramètres d'affichage, profondeur : mettre niveau 3)
        - Cocher 'transparent' pour la couleur de fond (clic droit, Paramètres d'affichage, Couleur de fond : Transparent)
   - (Indépendant du menu) Ajouter les équipements à afficher dans chaque Design du menu (lumières, portes, fenêtres, volets, etc..)

#### Paramétrage du menu (modification du fichier **/html/data/menusNoodom/menuAnimation/json/perso.json** et SEULEMENT ce fichier)

   - buttons : liste des boutons du menu
        - Modifier les valeurs label (Libellé du bouton), link (lien vers l'id d'un design) et color (couleur du bouton) pour personnaliser les boutons du menu

Pour information, les avantages de la gestion de la navigation du menu par frame :
- [x] Le code du menu est présent dans un seul Design : plus simple en cas de modifications nécessaires (un seul Design à modifier), pas de recopie nécessaire, pas d'oublis de modifications sur différents écrans
- [x] Les Designs de chaque bouton ne contiennent pas le code du menu :
- [x] On construit chaque écran lié à un bouton sans se soucier du menu choisi
- [x] On peut changer de menu sans modifier le contenu des écrans liés aux boutons : il suffit de créer autant de Design que de menus et ensuite, on appelle le design correspondant à un menu
   - Exemple : on crée un Design pour la navigation depuis un ordinateur, un autre menu pour une navigation depuis le mobile, un autre menu pour une navigation depuis une tablette.

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
>        - /menusNoodom
>            - /menuAnimation  
>                - /css/perso.css : le css du menu (Modification non nécessaire)
>                - /json/perso.json : le json de personnalisation du menu (A personnaliser)
