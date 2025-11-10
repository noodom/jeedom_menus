$(document).on('noo::gotoDesignWithParams', function(_e, payload) {
  const data = payload?.[0] || payload || {};
  const paramsEncoded = data.paramsEncoded;

  if (!paramsEncoded) {
    console.warn('Aucun paramsEncoded reçu');
    return;
  }

  let params = {};
  try { 
    params = JSON.parse(atob(paramsEncoded)); 
  } catch (e) { 
    console.error('Erreur de décodage paramsEncoded', e); 
    return; 
  }

  // Vérification utilisateur
  const target = params.username;
  if (target) {
    const authorizedUsers = Array.isArray(target) ? target : [target];
    if (!user_login || !authorizedUsers.includes(user_login)) {
      return;
    }
  }

  const design_id = params.design_id;
  
  const currentUrl = new URL(window.location.href);
  const fullscreenFromUrl = currentUrl.searchParams.get('fullscreen');
  if (params.fullscreen === undefined && fullscreenFromUrl !== null) {
    params.fullscreen = fullscreenFromUrl;
  }
  
  const isPageDesign = currentUrl.searchParams.get('p') === 'plan';
  const forceRedirection = params.force_redirection === 1;  

  if (design_id && (forceRedirection || isPageDesign)) {
    // Redirection vers le design
    const baseUrl = `index.php?v=d&p=plan&plan_id=${encodeURIComponent(design_id)}`;
    const query = Object.entries(params)
      .filter(([key]) => key !== 'design_id')
      .map(([k, v]) => `${encodeURIComponent(k)}=${encodeURIComponent(v)}`)
      .join('&');

    const newUrl = query ? `${baseUrl}&${query}` : baseUrl;
    window.location.href = newUrl;

  } else if (isPageDesign) {
    // Pas de design_id : on relaie localement vers le menu
	$(document).trigger('noo::gotoDesignWithParamsMenu', [params]);
  }
});