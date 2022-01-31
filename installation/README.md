#Initialisation d'un menu noodom pour Jeedom

:warning: Cette installation est nécessaire pour une compatibilité avec les nouvelles sécurités de Jeedom (et donc pour des menus compatibles Jeedom 4.2)

:warning: Les anciennes versions des menus installés dans le répertoire /html/montheme ne seront plus compatibles avec les nouvelles sécurités de Jeedom

La première étape d'installation d'un menu consiste à copier les fichiers nécessaires à son exécution.
Pour cela, il suffit d'exécuter le scénario [nooMenusFilesDownload](nooMenusFilesDownload.json) qui s'occupera de la recopie de ces fichiers.

Il faut alors suivre les étapes suivantes :

1. Télécharger le template du scénario disponible ici : [nooMenusFilesDownload](nooMenusFilesDownload.json)
2. Charger le scénario depuis Jeedom à partir du fichier de template du scénario

  - Sélectionner le menu "`Outils`" / "`Scénarios`"
  - Sélectionner "`Ajouter`" pour créer un nouveau scénario, lui donner un nom
  - Sélectionner le bouton `Template`

  ![template button](./installation/doc/images/templateButton.png)

  - Sélectionner "`Charger un template"` et sélectionner le fichier json du template de scénario

  ![load template](./installation/doc/images/templateLoad.png)

3. Appliquer le template chargé au scénario en cours de création

  - Sélectionner le template présent dans la liste des templates
  - Sélectionner le bouton "`Appliquer`" pour charger le template dans le scénario en cours de création

  ![apply template](./installation/doc/images/templateApply.png)

4. Exécution du scénario
  - Le nouveau scénario créé contient le contenu du template chargé
  - Dans le contenu du scénario, préciser le nom du menu à installer au niveau du tag "`menuName`" 
    (valeurs possibles actuellement : menuJsonFsb33Frame, menuAnimation, menuNooNeumorphism, menuVerticalTom, menuMobileSubMenuFrame, menuFloattingDraggable, menuHoverShow, menuInTheAir)
  - Exécuter le scénario


=> Les fichiers nécessaires à l'exécution du menu sont présents dans le répertoire **/html/data/menusNoodom/menuName**
