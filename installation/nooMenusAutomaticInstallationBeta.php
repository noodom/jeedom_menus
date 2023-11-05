/* @noodom / Automatic menu creation (beta version)
	- tag menuName : name of the menu to install (folders from https://github.com/noodom/jeedom_menus)
	
    - Download file /data/menusNoodom/.htAccess
	- Download menu files
 	- Create menu htmlDisplay and content htmlDisplay
 	- Create menu design (insert menu htmlDisplay and content htmlDisplay)

Menu list : 
- menus OK : menuJsonFsb33Frame, menuNooNeumorphism, menuVerticalTom, menuMobileSubMenuFrame, menuNavButton, menuNoo3DAnim, menuNooSliding, menuAnimation, menuInTheAir
- menus KO : menuFloattingDraggable, menuHoverShow

Menu installation details :
	- https://github.com/noodom/jeedom_menus/blob/master/installation/nooMenusAutomaticInstallationBeta.php
After installation :
	- Menu htmlDisplay not transparent : From design screen, edit design ('Edition'), configure design ('Configurer le design'), configure menu htmlDisplay ('Composants'->'Configuration') and save menu htmlDisplay ('Sauvegarder)
	- Problem with design display (loading, css at first launch) : refresh design

- Pensez au café pour les nuits blanches de codage ;) https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=noodom.fr%40gmail.com¤cy_code=EUR&source=url 

*/

$tags = $scenario->getTags();
(!isset($tags['#menuName#'])) ? $tags['#menuName#'] = 'menuJsonFsb33Frame' : null;
$menuName = $tags['#menuName#']; 

$scenario->setLog('## (Beta) Noodom menu automatic installation : ' . $menuName . ' ##');

$htmldisplayPluginInstalled = true;
try {
  	$htmldisplayPlugin = plugin::byId('htmldisplay');
}
catch (Exception $e) {
  	$scenario->setLog("Error : please, install HTML Display plugin");
	$htmldisplayPluginInstalled = false;
}

// Plugin HTML Display not installed : installation stopped
if (!$htmldisplayPluginInstalled) {
  return;
}

$menuHd = null;
$contentHd = null;
$menuDesign = null;

$suffixName = (strlen(trim($tags['#designSuffixName#'])) > 0) ? $tags['#designSuffixName#'] : ''; 
$contentHdName = 'noodom_content';
$designName = $suffixName; 

$defaultMenuWidth = 1280;
$defaultMenuHeight = 1000;

$menuHdFound = false;
$contentHdFound = false;
$designFound = false;

// Menus folder
$menusFolder = 'menusNoodom';
$originMenuDir = 'https://raw.githubusercontent.com/noodom/jeedom_menus/master/' . $menuName; 
// Origin folder and filenames
$originDir = $originMenuDir . '/data/' . $menusFolder; 
$originMenuFilename = 'index.html'; 
$originContentFilename = 'menuFrame.html'; 
// Destination folder
$destinationDir = '/var/www/html/data/' . $menusFolder;
// Zip menu file
$menuZipFile = $originDir . '/' . $menuName . '.zip'; 
// Htmldisplay plugin data path
$htmldisplayDatapathDir = '/var/www/html/plugins/htmldisplay/data';

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
$destinationMenu = $destinationDir . '/' . $menuName . $suffixName;
$destinationMenuBackup = $destinationDir . '/' . $menuName . $suffixName . '_backup';
if (is_dir($destinationMenu . '/.')) {
  // Delete backup folder
  if (is_dir($destinationMenuBackup)) {
  	$scenario->setLog('** Delete existing menu folder backup : ' . $destinationMenuBackup);
    rrmdir($destinationMenuBackup);
  }
  // Create new backup folder (move existing menu folder)
  $scenario->setLog('** Backup existing menu folder : ' . $destinationMenu . ' to ' . $destinationMenuBackup);
  rename($destinationMenu,$destinationMenuBackup);
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
      $zip->extractTo($destinationDir . '/temp');
      rename($destinationDir . '/temp/' . $menuName, $destinationDir . '/' . $menuName . $suffixName);
      $zip->close();
      unlink($destination);
    }
  }
}

// Create menu and content htmldisplays
$scenario->setLog('** Create menu and content htmldisplays');
$newMenuHdName = $menuName . $suffixName;
$newContentHdName = $contentHdName;
$eqLogics = eqLogic::byType('htmldisplay');
foreach ($eqLogics as $eqLogic) {
  // Menu htmlDisplay
  if ($eqLogic->getName() == $newMenuHdName) {
    $menuHdFound = true;
    $menuHd = $eqLogic;
    $scenario->setLog('- Menu HD ' . $newMenuHdName . ' found (id:' . $menuHd->getId() . ')');
  }

  // Content  htmlDisplay
  if ($eqLogic->getName() == $newContentHdName) {
    $contentHdFound = true;
    $contentHd = $eqLogic;
    $scenario->setLog('- Content HD ' . $newContentHdName . ' found (id:' . $contentHd->getId() . ')');
  }
}

if ($menuHdFound == false) {
  $menuHd = new htmldisplay();
  $menuHd->setName($newMenuHdName);
  $menuHd->setEqType_name("htmldisplay");
  $menuHd->setIsVisible(1);
  $menuHd->setIsEnable(1);
  $menuHd->save();
  $scenario->setLog('- Menu HD not found : create HD ' . $newMenuHdName . '(id:' . $menuHd->getId() . ')');
}
if ($contentHdFound == false) {
  $contentHd = new htmldisplay();
  $contentHd->setName($newContentHdName);
  $contentHd->setEqType_name("htmldisplay");
  $contentHd->setIsVisible(1);
  $contentHd->setIsEnable(1);
  $contentHd->save();
  $scenario->setLog('- Content HD not found : create HD ' . $newContentHdName . '(id:' . $contentHd->getId() . ')');
}

if (is_object($menuHd) &&  is_object($contentHd)) {
  // save menu HD dashboard
  $originUrl = $originMenuDir . '/' .$originMenuFilename;
  $scenario->setLog('- Save menu HD dashboard from ' . $originUrl);

  $filecontent = file_get_contents($originUrl);
  $path = $htmldisplayDatapathDir;
  if(!file_exists($path)){
    mkdir($path);
  }
  $path .= '/'.$menuHd->getId();
  if(!file_exists($path)){
    mkdir($path);
  }
  if (!file_exists($path)) {
    $scenario->setLog('Unable to create folder ' . $path);
  }
  else {
    if (!is_writable($path)) {
      $scenario->setLog('Unable to write in folder ' . $path);
    }
    else {
      if (!empty($suffixName)) {
        $scenario->setLog('- Create specific configuration files for ' . $suffixName);
        $scenario->setLog('- Modify perso.css and perso.json links for ' . $suffixName);
        $filecontent = str_replace ('data/menusNoodom/' . $menuName, 'data/menusNoodom/' . $menuName . $suffixName, $filecontent);
      }
      file_put_contents($path.'/dashboard.html', $filecontent);
      chmod($path, 0770);
    }
  }

  // save content HD dashboard
  $originUrl = $originMenuDir . '/' .$originContentFilename;
  $scenario->setLog('- Save content HD dashboard from ' . $originUrl);

  $filecontent = file_get_contents($originUrl);
  $path = $htmldisplayDatapathDir;
  if(!file_exists($path)){
    mkdir($path);
  }
  $path .= '/'.$contentHd->getId();
  if(!file_exists($path)){
    mkdir($path);
  }
  if (!file_exists($path)) {
    $scenario->setLog('Unable to create folder ' . $path);
  }
  else {
    if (!is_writable($path)) {
      $scenario->setLog('Unable to write in folder ' . $path);
    }
    else {
      file_put_contents($path.'/dashboard.html', $filecontent);
      chmod($path, 0770);
    }
  }
}

// Design creation
$newDesignName = $menuName . $designName;
$scenario->setLog('** Create Menu Design ' . $newDesignName);
$planHeaders = planHeader::all();
foreach ($planHeaders as $planHeader) {
	//if (!$planHeader->hasRight('r')) {
	//	continue;
	//}
	if ($planHeader->getName() == $newDesignName) {
      $menuDesign = $planHeader;
      $designFound = true;
      $scenario->setLog('- Design ' . $newDesignName . ' found :  ' . $menuDesign->getId());
    }
}

(!isset($tags['#menuDesignWidth#'])) ? $tags['#menuDesignWidth#'] = $defaultMenuWidth : null;
(!isset($tags['#menuDesignHeight#'])) ? $tags['#menuDesignHeight#'] = $defaultMenuHeight : null;

if ($designFound == false) {
  // create menu design
  $scenario->setLog('- Create design ' . $newDesignName);
  $menuDesign = new planHeader();
  $menuDesign->setName($newDesignName);
  $menuDesign->setId('');
  //$menuDesign->setConfiguration('desktopSizeX', $defaultMenuWidth);
  //$menuDesign->setConfiguration('desktopSizeY', $defaultMenuHeight);
  //$menuDesign->save();
}
//else {
  $menuDesign->setConfiguration('desktopSizeX', $defaultMenuWidth);
  $menuDesign->setConfiguration('desktopSizeY', $defaultMenuHeight);
  $menuDesign->save();
//}

$menuPlans = plan::byPlanHeaderId($menuDesign->getId());
foreach ($menuPlans as $menuPlan) {
  if (($menuPlan->getLink_id() != $menuHd->getId()) && ($menuPlan->getLink_id() != $contentHd->getId())) {
    $scenario->setLog('- Remove htmldisplay(s) (id:' . $menuPlan->getLink_id() . ') from design ' . $newDesignName . ' (id:' . $menuDesign->getId() . ')');
  	$menuPlan->remove();
  }
}
$menuPlan = plan::byLinkTypeLinkIdPlanHeaderId('eqLogic', $contentHd->getId(), $menuDesign->getId());
//if(count($menuPlan) == 0 || !is_object($menuPlan->getLink())) {
if ($menuPlan == null) {
  $scenario->setLog('- add content htmldisplay (id:' . $contentHd->getId() . ')');
  $menuPlan = new plan();
  $menuPlan->setId('');
  $menuPlan->setLink_type('eqLogic');
  $menuPlan->setLink_id($contentHd->getId());
  $menuPlan->setPlanHeader_id($menuDesign->getId());
  $menuPlan->setCss('z-index', 1000);
  $menuPlan->save();
}
$menuPlan = plan::byLinkTypeLinkIdPlanHeaderId('eqLogic', $menuHd->getId(), $menuDesign->getId());
//if(count($menuPlan) == 0 || !is_object($menuPlan->getLink())) {
if ($menuPlan == null) {
  $scenario->setLog('- add menu htmldisplay (id:' . $menuHd->getId() . ')');
  $menuPlan = new plan();
  $menuPlan->setId('');
  $menuPlan->setLink_type('eqLogic');
  $menuPlan->setLink_id($menuHd->getId());
  $menuPlan->setPlanHeader_id($menuDesign->getId());
  $menuPlan->setDisplay('background-transparent', 1);
  $menuPlan->setDisplay('background-defaut', 0);
  /*if($eqLogic->getDisplay('background-color-defaultplan') != 1){
          $plan->setDisplay('background-defaut',0);
          $plan->setCss('background-color',$eqLogic->getDisplay('background-colorplan'));
          $plan->setDisplay('background-transparent',$eqLogic->getDisplay('background-color-transparentplan'));
  }*/
  $menuPlan->setCss('z-index', 1003);
  //$menuPlan->setCss('background-color', 'transparent !important');
  //$menuPlan->setCss('background-color', 'red !important');
  //$('.eqLogic-widget[data-eqLogic_id="1485"]').attr('style', 'background-color: transparent !important');
  $menuPlan->save();
}

$scenario->setLog('==> Access to the menu ' . $menuName . ' : design id=' . $menuDesign->getId());
$msg = 'Menu généré :: #&l' . 't;a href="/index.php?v=d&p=plan&plan_id=' . $menuDesign->getId() . '&fullscreen=1" target="_blank"&g' . 't;' . $menuName . '&l' . 't;/a&g' . 't;# :' 
  . ' Design #&l' . 't;a href="/index.php?v=d&p=plan&plan_id=' . $menuDesign->getId() . '&fullscreen=1" target="_blank"&g' . 't;' . $menuDesign->getName() . ' (id : ' . $menuDesign->getId() . ')&l' . 't;/a&g' . 't;# ' 
  .'/ htmlDisplay du menu : #&l' . 't;a href="/index.php?v=d&m=htmldisplay&p=htmldisplay&id=' . $menuHd->getId() . '#dashboardtab" target="_blank"&g' . 't;' . $menuHd->getName() . ' (id : ' . $menuHd->getId() . ')&l' . 't;/a&g' . 't;# ' 
  . '/ htmlDisplay du contenu : #&l' . 't;a href="/index.php?v=d&m=htmldisplay&p=htmldisplay&id=' . $contentHd->getId() . '#dashboardtab" target="_blank"&g' . 't;' . $contentHd->getName() . ' (id : ' . $contentHd->getId() . ')&l' . 't;/a&g' . 't;#';
// PR : desktop/modal/message.display.php : $trs .= '<td class="message_action">' . html_entity_decode($message->getAction()) . '</td>';
// $actionMsg = html_entity_decode('#&l' . 't;a href="/index.php?v=d&p=plan&plan_id=' . $menuDesign->getId() . '&fullscreen=1" target="_blank"&g' . 't;Lancer le design&l' . 't;/a&g' . 't;#');
$actionMsg = '';
message::add('Génération de menu Noodom', $msg, $actionMsg, null);
