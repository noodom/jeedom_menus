# Menu F$B33 avec fichier de configuration JSon

Ce menu reprend le menu F$B33 en ajoutant la gestion des boutons par un paramétrage à partir d'un fichier JSon

## Installation du menu

### Avant d'inclure le menu, il faut commencer par les actions suivantes

   - Copier les dossiers **/css** et **/json** dans le répertoire **/html/montheme** à l'aide du plugin jeeExplorer

   - Editer le fichier **/json/perso.json** à l'aide du plugin jeeXplorer :
        - Pour chaque bouton du menu, mettre le lien vers un design (**link**) et le lien vers son image (**icon**)
   - Récupérer les images nécessaires du menu F$B33 et les copier sous **html/montheme/images**
   - Vérifier que le fichier **/json/perso.json** modifié est correct :
        - Copier son contenu ici : https://jsonlint.com/
        - Cliquer sur **'Validate JSON'**
        - Le résultat sous Results doit être vert avec le message **'Valid JSON'**

>Note : il n'y a plus besoin de modifier le code
>
>Seul le fichier perso.json est à adapter à son menu


Le menu est à ajouter dans chaque page de design.

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
>    - /montheme
>        - /css/perso.css : le css du menu
>        - /json/perso.json : le json de personnalisation du menu
>        - /images/ : les images du menu
