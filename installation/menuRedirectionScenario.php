// Scénario de redirection automatique des menus noodom
// => à recopier dans le bloc-code d'un scénario
// /!\ Seuls les paramètres sont à adapter pour vos menus

// Paramètres à envoyer
// - design_id : (optionnel) nécessaire si on veut ouvrir la page du menu même si le menu n'est pas ouvert
// - link_id : page de l'id de design correspondant à un bouton du menu -> lien de redirection demandé
// - forceRedirection : (optionnel) force la redirection de toutes les pages Jeedom actuellement ouvertes vers le design (design_id) et le bouton du menu (link_id) demandés
//        - design_id doit être précisé pour la prise en compte du paramètre force_redirection
//        - link_id est optionnel : permet d'ouvrir directement un des liens du menu
// - fullscreen : (optionnel) permet de forcer l'affichage plein écran du menu -> 0 : force l'affichage de menu Jeedom, 1 : force l'affichage plein écran du menu, pas de paramètre : conserve la valeur actuelle de la page Jeedom
// - username : filtre sur les utilisateurs
//        - filtre sur un seul utilisateur avec 'username' => 'admin' 
//        - ou filtre sur plusieurs utilisateurs : 'username' => ['admin', 'noodom']

$params = [
  'design_id' => 121,
  'link_id' => 53,
  'force_redirection' => 0,
  'fullscreen' => 1,
  'username' => ['admin', 'noodom']
];

// Envoi des paramètres de redirection pour un nooMenu
try {
    $encoded = base64_encode(json_encode($params, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR));
    event::add('noo::gotoDesignWithParams', ['paramsEncoded' => $encoded]);
} catch (JsonException $e) {
    $scenario->setLog('event noo::gotoDesignWithParams [Erreur JSON pour les paramètres] : ' . $e->getMessage());
}