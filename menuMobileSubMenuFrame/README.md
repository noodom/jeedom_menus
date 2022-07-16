# Menu Mobile Sub Menu avec fichier de configuration JSon et gestion de navigation par Frame
![Menu HoverShow](./doc/images/menuOuvert.png)

Ce menu affiche un menu en bas d'écran pour mobile.
Il affiche un bouton "Menu" au centre et 2 boutons de liens vers des designs à gauche et à droite de ce bouton.
La sélection du bouton Menu affiche une nouvelle ligne de boutons permettant l'affichage de nouveaux designs.

Au chargement, le contenu affiché est celui du bouton de gauche du Menu si aucun lien n'est configuré pour le bouton Menu.

En définissant un lien pour le bouton Menu, c'est ce contenu qui sera affiché par défaut au démarrage (Dans cette configuration, un double clic sur le bouton Menu affiche ce contenu à tout moment).

Cliquez ici pour la vidéo de présentation :

[![Présentation vidéo](https://img.youtube.com/vi/z3bSMKbSDKY/0.jpg)](https://www.youtube.com/watch?v=z3bSMKbSDKY)

## Installation du menu

▶️ Avant d'inclure le menu, il faut commencer par les actions suivantes

   - Créer le scénario d'installation automatique d'un menu noodom, si premier menu généré (disponible [ici](../installation/README.md))
      - Préciser le nom du menu **menuMobileSubMenuFrame** dans le tag **menuName** du scénario (Détail des autres tags dans la procédure pour les autres tags)
      - Exécuter le scénario => Le design du menu est créé automatiquement
   - Editer le fichier **/html/data/menusNoodom/menuMobileSubMenuFrame/json/perso.json** à l'aide de l'éditeur de fichier (plugin jeeExplorer ou menu Réglages/Système/Editeur de fichiers à partir de Jeedom 4.2) :
        - Suivre les indications détaillées sur le paramétrage du paragraphe **Paramétrage du menu**
   - Vérifier que le fichier **/json/perso.json** modifié est correct :
        - Copier son contenu ici : https://jsonlint.com/
        - Cliquer sur **'Validate JSON'**
        - Le résultat sous Results doit être vert avec le message **'Valid JSON'**

▶️ Installation pour une gestion de la navigation par frame

Principe : Un design contient le menu et les autres designs ne contiennent que le contenu des pages correspondantes à chaque bouton du menu (plus besoin d'inclure le menu sur chaque page)

   - Créer un Design pour chaque lien des boutons du menu si pas encore existants (Prévoir de respecter la taille du Design en fonction de l'affichage final dans la frame)
		- Ces menus ne contiennent pas le menu mais seulement les éléments de Jeedom à visualiser pour cet écran
		- Préciser ces liens dans le fichier de configuration **/json/perso.json** pour la navigation du menu si nécessaire
   - (Indépendant du menu) Ajouter les équipements à afficher dans chaque Design du menu (lumières, portes, fenêtres, volets, etc..)

▶️ Paramétrage du menu (modification du fichier /html/data/menusNoodom/menuMobileSubMenuFrame/json/perso.json et SEULEMENT ce fichier)

   - **buttons** : liste des boutons du haut du menu
      - modifier les valeurs **label** (Libellé du bouton), **link** (lien vers l'id d'un design) et **icon** (icône du bouton au format font-awesome) pour personnaliser les boutons du menu
      - Attention, vérifier que chaque lien saisi corresponde bien à un design existant   

   - **buttons_bottom** : liste des boutons du bas du menu
      - modifier les valeurs **label** (Libellé du bouton), **link** (lien vers l'id d'un design) et **color** (icône du bouton au format font-awesome) pour personnaliser les boutons du menu
      - Remarque : la valeur link pour le bouton Menu du milieu n'est pas nécessaire
      - Attention, vérifier que chaque lien saisi corresponde bien à un design existant

   - **parameters** : positions et tailles du menu et de la frame du contenu (par défaut pour une définition de 320px * 500px)
      - **menu_x** : position x du menu (par défaut "0px")
      - **menu_y** : position y du menu (par défaut "396px")
      - **menu_width** : largeur du menu (par défaut "320px")
      - **menu_height** : hauteur du menu (par défaut "104px")

      - **content_x** : position x du contenu du contenu (par défaut "0px")
      - **content_y** : position y du contenu du contenu (par défaut "0px")
      - **content_width** : largeur du contenu du contenu (par défaut "320px")
      - **content_height** : hauteur du contenu du contenu (par défaut "500px")        

Pour information, les avantages de la gestion de la navigation du menu par frame :
- [x] Le code du menu est présent dans un seul Design : plus simple en cas de modifications nécessaires (un seul Design à modifier), pas de recopie nécessaire, pas d'oublis de modifications sur différents écrans
- [x] Les Designs de chaque bouton ne contiennent pas le code du menu :
- [x] On construit chaque écran lié à un bouton sans se soucier du menu choisi
- [x] On peut changer de menu sans modifier le contenu des écrans liés aux boutons : il suffit de créer autant de Design que de menus et ensuite, on appelle le design correspondant à un menu
   - Exemple : on crée un Design pour la navigation depuis un ordinateur, un autre menu pour une navigation depuis le mobile, un autre menu pour une navigation depuis une tablette.

>**Note** : il n'y a plus besoin de modifier le code (moins de risque d'erreur)
>
>Seul le fichier  **/html/data/menusNoodom/menuMobileSubMenuFrame/json/perso.json** est à adapter à son menu

#### Points à valider suite à l'installation

   - Créer un Design si non existant pour chaque lien des boutons du menu (Prévoir de respecter la taille du Design en fonction de l'affichage final dans la frame)
        - Ces menus ne contiennent pas le menu mais seulement les éléments de Jeedom à visualiser pour cet écran
        - Préciser ces liens dans le fichier de configuration /json/perso.json pour la navigation du menu si nécessaire
   - (Indépendant du menu) Pour ces designs, ajouter les différents équipements à afficher (lumières, portes, fenêtres, volets, etc..)

#### Messages d'erreurs possibles

   - "**Attention, il manque la création de l'équipement htmlDisplay pour la gestion par frame**" : l'équipement htmlDisplay **Contenu** pour la frame de destination des liens des boutons n'a pas été créé, à ajouter.
   - "**Attention, corrigez le lien 42 du bouton libelleBouton qui pointe vers le menu principal (boucle sans fin)**" : un lien saisi dans perso.json est identique au design principal contenant le menu, à corriger.

>### Création d'un équipement du plugin Html Display pour ajout dans un Design
>
>   - Depuis le plugin HTML Display, créer un nouvel équipement
>   - Recopier le contenu du fichier index.html dans cet équipement et sauvegarder
>   - Depuis un design, passer en mode édition (Clic droit, puis sélectionner 'Edition')
>   - Clic droit, puis sélectionner **'Ajouter équipement'**
>   - Sélectionner l'équipement HTML Display créé précédemment

>**Note** : On aura alors l'arborescence suivante (A vérifier avec le plugin jeeExplorer) :
>
>- /html
>  - /data
>    - /menusNoodom
>      - /menuMobileSubMenuJsonFrame
>        - /css/perso.css, perso-up.css : le css du menu
>          - /json/perso.json, perso-h.json : les fichiers json de personnalisation du menu
>          - /img/ : les images du menu

>**Note** : Pour utiliser le menu avec un affichage en haut de l'écran, il faut remplacer les fichiers suivants pendant l'installation :
>
>- remplacer index.html par index-up.html
>- remplacer perso.css par perso-up.css
>- remplacer perso.json par perso-h.json

Liste des icônes font-awesome pour l'affichage des boutons :
- https://fontawesome.com/icons?m=free
