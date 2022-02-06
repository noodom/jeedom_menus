# Menu Mobile Hover Show avec fichier de configuration JSon
![Menu HoverShow](./doc/images/menuOuvert.png)

Ce menu affiche un menu vertical sur la gauche de l'écran d'écran.
Il affiche un menu haut et un menu bas. Chaque bouton du menu lance l'affichage d'un nouvel écran de Design.

## Installation du menu

### Avant d'inclure le menu, il faut commencer par les actions suivantes

   - Récupérer le template de scénario [nooMenusFilesDownload](../installation/nooMenusFilesDownload.json) ( Tuto détaillé [ici](../installation/README.md) )
        - Installer le scénario à partir du template
        - Préciser la valeur menuHoverShow pour le tag menuName en début de scénario
        - Exécuter le scénario => Les fichiers du scénario sont bien recopiés
   - Editer le fichier **/json/perso.json** à l'aide de l'éditeur de fichier (plugin jeeExplorer ou menu Réglages/Système/Editeur de fichiers à partir de Jeedom 4.2) :
        - Pour chaque bouton du menu, mettre le libellé du bouton (**label**), le lien vers un design (**link**) et le lien vers son image (**icon**) au format font-awesome
        - **fa-menu-2x** est facultatif : il double la taille de l'icône du bouton (le supprimer pour réduire la taille de l'icône)
   - Vérifier que le fichier **/json/perso.json** modifié est correct :
        - Copier son contenu ici : https://jsonlint.com/
        - Cliquer sur **'Validate JSON'**
        - Le résultat sous Results doit être vert avec le message **'Valid JSON'**

>Note : il n'y a plus besoin de modifier le code
>
>Seul le fichier perso.json est à adapter à son menu


Le menu est à ajouter dans chaque page de Design.

2 possibilités pour ajouter le menu dans une page de Design :

### Ajout dans un texte/html

   - Depuis un design, passer en mode édition (Clic droit, puis sélectionner **'Edition'**)
   - Clic droit, puis sélectionner **'Ajouter texte/html'**
   - Clic droit sur le 'texte/html' créé, puis sélectionner **'Paramètres d'affichage'**
   - Mettre 0 pour **'Position X'** et **'Position Y'** (positionne le menu en haut à gauche)
   - Dans la zone **'Texte'**, recopier le contenu du fichier **index.html**, puis sélectionner **'Sauvegarder'**
   - Depuis le design, sélectionner la flèche sur le texte/html pour donner la taille souhaitée au menu

### Ajout comme équipement du plugin Html Display

   - Depuis le plugin HTML Display, créer un nouvel équipement
   - Recopier le contenu du fichier index.html dans cet équipement et sauvegarder
   - Depuis un design, passer en mode édition (Clic droit, puis sélectionner 'Edition')
   - Clic droit, puis sélectionner **'Ajouter équipement'**
   - Sélectionner l'équipement HTML Display créé précédemment
   - Redimensionner cet équipement

>**Note** : On aura alors l'arborescence suivante (A vérifier avec le plugin jeeExplorer) :
>
>- /html
>    - /data
>        - /menusNoodom
>           - /menuHoverShow
>              - /css/perso.css : le css du menu
>        	   - /json/perso.json : le json de personnalisation du menu
>        	   - /img/ : les images du menu

Liste des icônes font-awesome pour l'affichage des boutons :
- https://fontawesome.com/icons?m=free
