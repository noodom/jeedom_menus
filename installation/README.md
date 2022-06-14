# Installation automatique d'un menu noodom (nouvelle installation)

Cette installation permet de créer les différents menus automatiquement à partir du scénario suivant.

![captureScenarioInstallationAutomatique](./doc/images/nooMenusAutomaticInstallation.png)

1️⃣ 1. Créer un nouveau scénario

2️⃣ Ajouter une action tag menuName nomDuMenu

3️⃣ Ajouter un bloc-code et copier le code ![ici](./nooMenusAutomaticInstallation.php)

4️⃣ Exécuter le scénario

5️⃣ Le menu est généré automatiquement : 

   - il est visible dans la liste des designs
   - il est accessible directement dans la liste des messages (lien du design et des htmlDisplays du menu et du contenu disponible dans le message)

:warning: Menus compatibles :
- L'installation est possible pour les menus suivants : **menuJsonFsb33Frame**, **menuNooNeumorphism**, **menuVerticalTom**, **menuMobileSubMenuFrame**, **menuNavButton**, **menuNoo3DAnim**, **menuNooSliding**.
- **menuAnimation** : il faut modifier manuellement les position et taille des htmlDisplays du menu et du contenu (Depuis le design : `Edition`, `Configurer le design`, `Composants`->`Configuration` puis `Sauvegarder`)
- En cas de problème d'affichage après génération (chargement, problème de CSS), rafraichir la page du design

# Initialisation d'un menu noodom pour Jeedom (Ancienne installation)

:warning: Cette installation est nécessaire pour une compatibilité avec les nouvelles sécurités de Jeedom (et donc pour des menus compatibles Jeedom 4.2)

:warning: Les anciennes versions des menus installés dans le répertoire /html/montheme ne seront plus compatibles avec les nouvelles sécurités de Jeedom

La première étape d'installation d'un menu consiste à copier les fichiers nécessaires à son exécution.
Pour cela, il suffit d'exécuter le scénario [nooMenusFilesDownload](nooMenusFilesDownload.json) qui s'occupera de la recopie de ces fichiers.

Il faut alors suivre les étapes suivantes :

1️⃣ Télécharger le template du scénario disponible ici : [nooMenusFilesDownload](nooMenusFilesDownload.json)
2️⃣ Charger le scénario depuis Jeedom à partir du fichier de template du scénario

  - Sélectionner le menu `Outils` / `Scénarios`
  - Sélectionner `Ajouter` pour créer un nouveau scénario, lui donner un nom
  - Sélectionner le bouton `Template`

    ![template button](./doc/images/templateButton.png)

  - Sélectionner "`Charger un template"` et sélectionner le fichier json du template de scénario

    ![load template](./doc/images/templateLoad.png)

3️⃣ Appliquer le template chargé au scénario en cours de création

  - Sélectionner le template présent dans la liste des templates
  - Sélectionner le bouton "`Appliquer`" pour charger le template dans le scénario en cours de création

    ![apply template](./doc/images/templateApply.png)

4️⃣ Exécution du scénario
  - Le nouveau scénario créé contient le contenu du template chargé
  - Dans le contenu du scénario, préciser le nom du menu à installer au niveau du tag "`menuName`" 

    (valeurs possibles actuellement : **menuJsonFsb33Frame**, **menuNooSliding**, **menuNoo3DAnim**, **menuAnimation**, **menuNooNeumorphism**, **menuVerticalTom**, **menuMobileSubMenuFrame**, **menuFloattingDraggable**, **menuHoverShow**, **menuInTheAir**)
  - Exécuter le scénario


=> Les fichiers nécessaires à l'exécution du menu sont présents dans le répertoire **/html/data/menusNoodom/menuName**

>**Note** : En cas de problème d'import du template, ci-dessous une capture du scénario final avec le code à insérer dans le bloc-code
>
>Attention à bien renseigner le nom du menu souhaité dans le tag **menuName**

**Capture du scénario d'installation**

![captureScenario](./doc/images/captureScenario.png)

**Bloc-Code du scénario d'installation**

```// Noodom menus installation
// - Download file /data/menusNoodom/.htAccess
// - Download menu files
  
// Menu name
// => menuJsonFsb33Frame, menuAnimation, menuNooNeumorphism, menuVerticalTom, menuMobileSubMenuFrame, menuFloattingDraggable, menuHoverShow, menuInTheAir
$tags = $scenario->getTags();
(!isset($tags['#menuName#'])) ? $tags['#menuName#'] = 'menuJsonFsb33Frame' : null;
$menuName = $tags['#menuName#']; 

// Menus folder
$menusFolder = 'menusNoodom';
// Origin folder
$originDir = 'https://raw.githubusercontent.com/noodom/jeedom_menus/master/' . $menuName . '/data/' . $menusFolder; 
// Destination folder
$destinationDir = '/var/www/html/data/' . $menusFolder;
// Zip menu file
$menuZipFile = $originDir . '/' . $menuName . '.zip'; 

// Create menus folder /menusNoodom
if (!is_file($destinationDir) && !is_dir($destinationDir)) {
  $scenario->setLog('Destination dir creation (menus folder) : ' . $destinationDir);
  mkdir($destinationDir);
}

// Get .htaccess file
if (is_dir($destinationDir) . '/.') {
  $scenario->setLog('** Get .htaccess file');
  $originUrl = $originDir . '/.htaccess';

  $filename = basename($originUrl); 
  $save = $destinationDir . '/' . $filename;
  $scenario->setLog('- Origin filename : ' . $originUrl);
  $scenario->setLog('- Destination filename : ' . $save);
  if (file_put_contents($save,file_get_contents($originUrl))) {
    $scenario->setLog('- .htaccess downloaded !');
  }
}

// Get menu files
$destinationMenu = $destinationDir . '/' .$menuName;
if (is_dir($destinationMenu . '/.')) {
  // Delete existing menu folder
  $scenario->setLog('** Delete existing menu folder : ' . $destinationMenu);
  rrmdir($destinationMenu);
}

if (is_dir($destinationDir)) {
  $scenario->setLog('** Get files for menu ' . $menuName);
  $scenario->setLog('- Get menu zip file : ' . $menuZipFile);
  $destination = $destinationDir . '/temp.zip';
  $scenario->setLog('- Destination menu zip file : ' . $destination);
  if (!copy($menuZipFile, $destination)) {
    $scenario->setLog('/!\ Menu zip file download failed !');
  }
  else {
    $zip = new ZipArchive();
    if ($zip->open($destination) === TRUE) {
      $scenario->setLog('- Extract files from menu : ' . $menuName);
      $zip->extractTo($destinationDir . '/');
      $zip->close();
      unlink($destination);
    }
  }
}
```
